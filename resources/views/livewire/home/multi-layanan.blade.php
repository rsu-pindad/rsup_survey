<?php

use function Livewire\Volt\{state, layout, title};

layout('components.layouts.pegawai');
title('Halaman Multi Layanan');

?>

<div>

  <div class="grid grid-cols-3 gap-2">
    <div class="flex flex-row">
      <div class="shrink-0">
        <h1 class="my-4 block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight">
          {{ $this->unit->nama_unit }}
        </h1>
        {!! $this->unit->unitProfil->unit_motto !!}
      </div>
    </div>
    <div class="flex items-center justify-center">
      <div class="group mx-0 my-4 block px-4">
        <div>
          <h3 class="text-md text-center font-semibold text-gray-800">
            Waktu Survey
          </h3>
        </div>
        <div>
          <h2 id="waktuSurvey"
              x-data
              x-timeout:1000="$el.innerText=$moment().format('HH:mm:ss')"
              class="text-center text-xl font-bold">
          </h2>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-end">
      <div class="group my-4 block h-60 w-60 rounded-xl focus:outline-none">
        <!-- Card -->
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl">
          <img class="h-full w-full rounded-xl object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105"
               src="{{ Storage::disk('public')->url($this->unit->unitProfil->unit_sub_logo ?? 'photos/logopmu.png') }}"
               alt="Sub Logo">
        </div>
        <div class="realtive bottom-0 end-0 start-0 p-2">
          <button type="button"
                  class="w-full rounded-lg bg-green-600 p-3 text-center font-semibold hover:bg-green-400 active:bg-blue-600">
            Mulai Survey
          </button>
        </div>
        <!-- End Card -->
      </div>
    </div>
  </div>

</div>
