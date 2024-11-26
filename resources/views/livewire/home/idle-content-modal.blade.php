<?php

use App\Models\PenjaminLayanan;
use function Livewire\Volt\{state, mount, rules, action};
state(['penjamin', 'radioPenjamin']);
mount(function (PenjaminLayanan $penjaminLayanan) {
    $this->penjamin = $penjaminLayanan
        ->with('parentPenjamin')
        ->where('layanan_id', Auth::user()->parentKaryawanProfile()->value('layanan_id'))
        ->get();
});
rules(['radioPenjamin' => 'required'])->messages([
    'radioPenjamin.required' => 'Mohon pilih salah satu penjamin',
]);
$selanjutnya = action(function () {
    $this->validate();
    to_route('survey-pasien', ['penjamin' => $this->radioPenjamin]);
});
?>

<x-wireui-modal-card name="penjaminModal"
                     blur="xl"
                     width="fullscreen"
                     align="center"
                     persistent>
  <x-slot:title>
    <h1 class="mx-auto text-5xl uppercase">Pilih Penjamin</h1>
  </x-slot:title>
  <form method="post">
    <div class="grid grid-cols-2 gap-x-8 gap-y-6">
      @forelse ($this->penjamin as $p)
        <label class="has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-300 flex flex-row items-stretch rounded-full border p-3"
               wire:key="{{ $p->parentPenjamin->id }}">
          <div class="self-center">
            <x-wireui-radio wire:model.blur="radioPenjamin"
                            value="{{ Str::lower($p->parentPenjamin->nama_penjamin) }}"
                            with-validation-colors
                            positive
                            xl
                            wire:key="{{ $p->parentPenjamin->id }}">
            </x-wireui-radio>
          </div>
          <div class="self-center">
            <h1 class="ml-4 font-sans text-3xl uppercase">{{ $p->parentPenjamin->nama_penjamin }}</h1>
          </div>
        </label>
      @empty
        <label class="text-center font-bold">Penjamin belum tersedia</label>
      @endforelse
    </div>

    <x-slot name="footer"
            class="grid grid-flow-col justify-stretch gap-x-4">
      <x-wireui-button label="Kembali"
                       x-on:click="close"
                       icon="arrow-left"
                       rounded-sm
                       secondary
                       xl />

      <x-wireui-button type="submit"
                       label="Pilih"
                       wire:click="selanjutnya"
                       right-icon="arrow-right"
                       rounded-sm
                       positive
                       xl />
    </x-slot>
  </form>
</x-wireui-modal-card>
