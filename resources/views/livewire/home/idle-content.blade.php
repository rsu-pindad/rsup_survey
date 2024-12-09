<?php

use App\Models\{Layanan, Unit};
use function Livewire\Volt\{state, locked, boot};
state(['layanan', 'unit']);
boot(function () {
    // $this->isMultiLayanan = Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->value('multi_layanan');
    $this->layanan = Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'));
    $this->unit = Unit::find(Auth::user()->parentKaryawanProfile()->value('unit_id'));
});
?>

<div>
  <div class="grid grid-cols-3 gap-2">
    <div class="inline-flex grow justify-start">
      <article class="text-pretty">
        <h1
            class="text-wrap text-4xl font-bold text-gray-800 sm:text-2xl md:text-4xl md:leading-tight lg:text-5xl lg:leading-tight">
          {{ $this->unit->nama_unit }}
        </h1>
        {!! $this->unit->unitProfil->unit_motto !!}
      </article>
    </div>
    <div class="inline-flex shrink items-center justify-center">
      <div class="group mx-0 my-4 block px-4">
        <h4 class="text-center text-lg font-semibold">
          Layanan
        </h4>
        <h3 class="text-center text-lg font-bold">
          {{ $this->layanan->nama_layanan }}
        </h3>
        <h4 class="text-center text-lg font-semibold">
          Waktu Survey
        </h4>
        <h2 id="waktuSurvey"
            x-data
            x-timeout:1000="$el.innerText=$moment().format('HH:mm:ss')"
            class="text-center text-2xl font-bold">
        </h2>
      </div>
    </div>
    <div class="inline-flex grow items-center justify-end">
      <div class="group my-4 block h-60 w-60 rounded-xl focus:outline-none">
        <!-- Card -->
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl">
          <img class="h-full w-full rounded-xl object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105"
               src="{{ Storage::disk('public')->url($this->unit->unitProfil->unit_sub_logo ?? 'photos/logopmu.png') }}"
               alt="Sub Logo">
        </div>
        <div class="realtive bottom-0 end-0 start-0 p-2">
          <x-wireui-button label="Mulai Survey"
                           right-icon="arrow-right"
                           class="w-full p-3 text-center font-semibold uppercase"
                           x-on:click="$openModal('penjaminModal')"
                           rounded
                           green
                           xl />
        </div>
        <!-- End Card -->
      </div>
    </div>
  </div>

  <livewire:home.idle-content-modal />

</div>
