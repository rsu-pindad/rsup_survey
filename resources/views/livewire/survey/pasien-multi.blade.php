<?php

use App\Models\{Layanan, Penjamin, LayananRespon};
use function Livewire\Volt\{state, layout, title, mount, computed, updated};
layout('components.layouts.home');
title('Halaman Survey Pasien');
state([
    'penjamin' => null,
    'namaLayanan' => null,
    'layananId' => null,
    'radioLayanan' => null,
    'selectRespon' => null,
]);
mount(function (LayananRespon $layananRespon) {
    $this->penjamin = Penjamin::where('nama_penjamin', request()->query('penjamin'))->get();
    // $this->radioLayanan = null;
});

updated([
    'radioLayanan' => function () {
        $this->radioLayanan;
    },
]);

$layanan = computed(function () {
    return Layanan::where('multi_layanan', false)->get();
});

$respon = computed(function () {
    return LayananRespon::with('parentRespon')
        ->join('respon', 'layanan_respon.respon_id', '=', 'respon.id')
        ->where('layanan_id', $this->radioLayanan)
        ->orderBy('respon.urutan_respon', 'ASC')
        ->get();
});
?>

<section class="mx-auto">

  <div class="max-w-max px-3">
    <div class="flex flex-nowrap gap-4 border-b-2 pt-2">
      <div class="group block justify-center">
        <h1 class="align-middle font-bold uppercase sm:text-xl md:text-2xl lg:text-4xl">
          Survey Layanan {{ $this->namaLayanan }}
        </h1>
        <h1 class="align-middle font-semibold uppercase sm:text-xl md:text-2xl lg:text-4xl">
          Penjamin {{ $this->penjamin->value('nama_penjamin') }}
        </h1>
      </div>
      <div class="group mx-auto block">
        <h1 class="mx-auto font-semibold uppercase text-gray-800 sm:text-lg lg:text-3xl">
          Waktu Survey
        </h1>
        <h1 id="waktuSurvey"
            x-data
            x-timeout:1000="$el.innerText=$moment().format('HH:mm:ss')"
            class="text-center text-xl font-bold">
        </h1>
      </div>
    </div>
  </div>

  <div class="mx-auto my-2 flex gap-x-2">
    <div class="grid h-72 w-64 grid-flow-row gap-y-2 overflow-y-scroll rounded-lg bg-gray-100 shadow">
      {{-- <form> --}}
      @foreach ($this->layanan as $l)
        <div class="px-3 py-2">
          <label class="has-[:checked]:animate-pulse has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-300 flex flex-row items-stretch rounded-full border bg-white p-2"
                 wire:key="{{ $l->id }}">
            <div class="self-center">
              <x-wireui-radio id="{{ $l->id }}"
                              wire:model.change="radioLayanan"
                              wire:key="{{ $l->id }}"
                              value="{{ $l->id }}"
                              with-validation-colors
                              positive
                              md>
              </x-wireui-radio>
            </div>
            <div class="self-center">
              <h1 class="ml-4 font-sans text-3xl uppercase">{{ $l->nama_layanan }}</h1>
            </div>
          </label>
        </div>
      @endforeach
      {{-- </form> --}}
    </div>
    <div class="grid h-72 grow grid-flow-col overflow-x-scroll">
      @foreach ($this->respon as $r)
        <label wire:loading.remove
               class="has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-200 has-[:checked]:outline-2 has-[:checked]:scale-90 has-[:checked]:rounded-2xl flex grow scale-95 animate-[wiggle_1s_ease-in-out_infinite] flex-col justify-stretch rounded-lg border text-center md:h-64 md:w-44 md:p-2">
          <livewire:survey.respon-card wire:key="{{ $r->parentRespon->id }}"
                                       :colorText="$r->parentRespon->tag_warna_respon"
                                       :namaRespon="$r->parentRespon->nama_respon"
                                       :iconRespon="$r->parentRespon->icon_respon" />
          {{-- <div class="mx-auto mt-auto flex-none"> --}}
          <div class="mx-auto mt-auto items-stretch">
            <x-wireui-radio id="{{ $r->id }}"
                            class="has-[:checked]:animate-ping"
                            wire:model="selectRespon"
                            value="{{ $r->parentRespon->id }}"
                            wire:key="{{ $r->parentRespon->id }}"
                            with-validation-colors
                            positive
                            lg />
          </div>
        </label>
      @endforeach
    </div>
  </div>

  <div class="fixed bottom-0 left-0 right-0 flex max-w-full flex-nowrap gap-4 px-6 py-3">
    <div class="flex-none place-content-center">
      <x-wireui-button icon="arrow-left"
                       label="Kembali"
                       class="w-full"
                       type="button"
                       wire:click="kembali"
                       secondary
                       rounded />
    </div>
    <div class="flex-grow">
      <x-wireui-button right-icon="arrow-right"
                       label="Selanjutnya"
                       class="w-full"
                       wire:click="nilai"
                       interaction="info"
                       positive
                       rounded
                       lg />
    </div>
  </div>

</section>
