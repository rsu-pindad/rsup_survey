<?php

use App\Models\{Layanan, Unit};
use function Livewire\Volt\{state, layout, title, mount};

layout('components.layouts.home');
title('Halaman Beranda');
state([
    'unit' => Unit::find(Auth::user()->parentKaryawanProfile()->value('unit_id')),
    'layanan' => Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->value('nama_layanan'),
])->locked();
mount(function () {
    $this->unitAlamat = $this->unit->unitProfil->unit_alamat;
});
?>

<section class="mx-auto my-4">

  <x-slot:logoMain>
    {{ $this->unit->unitProfil->unit_main_logo }}
  </x-slot:logoMain>
  <x-slot:namaUnit>
    {{ $this->unit->nama_unit }}
  </x-slot:namaUnit>
  <x-slot:alamatUnit>
    {!! $this->unit->unitProfil->unit_alamat !!}
  </x-slot:alamatUnit>

  <livewire:home.idle-content />

</section>
