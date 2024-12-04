<?php

use function Livewire\Volt\{state, layout, title, mount, computed};
use App\Models\{SurveyPelanggan, KaryawanProfile, PenjaminLayanan};
use Illuminate\Support\Carbon;
layout('components.layouts.office');
title('Halaman Survey Masuk');
state([
    'karyawanProfile' => KaryawanProfile::find(Auth::user()->parentKaryawanProfile()->value('id')),
    'totalSurveyMasuk' => null,
    'totalDataPenjamin' => null,
]);
mount(function () {
    $this->totalSurveyMasuk = SurveyPelanggan::where('karyawan_id', $this->karyawanProfile->id)->count();
    $this->totalDataPenjamin = PenjaminLayanan::where('layanan_id', $this->karyawanProfile->layanan_id)->count();
});

$dataPenjamin = computed(function () {
    return PenjaminLayanan::with(['parentPenjamin'])
        ->where('layanan_id', $this->karyawanProfile->layanan_id)
        ->get();
});

?>

<section class="item s-start mx-auto flex h-screen flex-row flex-wrap justify-center justify-self-stretch">

  <!-- Card Section -->
  <div class="mx-auto max-w-[85rem] sm:px-3 sm:py-3 lg:px-4 lg:py-7">
    <!-- Grid -->
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
      <div class="grid gap-y-4 lg:col-span-2">
        <div
             class="flex items-center py-3 text-sm text-gray-800 after:ms-6 after:flex-1 after:border-t after:border-gray-200">
          Survey Masuk</div>
        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm">
          <div class="flex justify-between gap-x-3 p-4 md:p-5">
            <div>
              <p class="text-xs uppercase tracking-wide text-gray-500">
                Total Survey Masuk
                <span> sampai </span>
                {{ Carbon::now()->toDateString() }}
              </p>
              <div class="mt-1 flex items-center gap-x-2">
                <h3 class="text-xl font-medium text-gray-800 sm:text-2xl">
                  {{ $this->totalSurveyMasuk }}
                </h3>
                <span class="flex items-center gap-x-1 text-green-600">
                  <svg class="size-5 inline-block self-center"
                       xmlns="http://www.w3.org/2000/svg"
                       width="24"
                       height="24"
                       viewBox="0 0 24 24"
                       fill="none"
                       stroke="currentColor"
                       stroke-width="2"
                       stroke-linecap="round"
                       stroke-linejoin="round">
                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
                    <polyline points="16 7 22 7 22 13" />
                  </svg>
                  <span class="inline-block text-lg">
                    1.7%
                  </span>
                </span>
              </div>
            </div>
            <div class="size-[46px] flex shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
              <svg class="size-5 shrink-0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9"
                        cy="7"
                        r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
            </div>
          </div>

          <a class="inline-flex items-center justify-between rounded-b-xl border-t border-gray-200 px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none md:px-5"
             href="{{ route('office-grafik') }}">
            Lihat Grafik
            <svg class="size-4 shrink-0"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </a>
        </div>
        <!-- End Card -->
      </div>

      <div class="grid gap-y-4 lg:col-span-2">
        <div
             class="flex items-center py-3 text-sm text-gray-800 after:ms-6 after:flex-1 after:border-t after:border-gray-200">
          Data Layanan</div>
        <!-- Card -->
        <div class="flex flex-col rounded-xl border bg-white shadow-sm">
          <div class="flex justify-between gap-x-3 p-4 md:p-5">
            <div>
              <p class="text-xs uppercase tracking-wide text-gray-500">
                Total Penjamin Layanan
              </p>
              <div class="mt-1 flex items-center gap-x-2">
                <h3 class="mt-1 text-xl font-medium text-gray-800">
                  {{ $this->totalDataPenjamin }}
                </h3>
              </div>
            </div>
            <div class="size-[46px] flex shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
              <svg class="size-5 shrink-0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="M5 22h14" />
                <path d="M5 2h14" />
                <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
              </svg>
            </div>
          </div>

          <a class="inline-flex items-center justify-between rounded-b-xl border-t border-gray-200 px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none md:px-5"
             href="#">
            View reports
            <svg class="size-4 shrink-0"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </a>
        </div>
        <!-- End Card -->
      </div>

      <div class="col-span-2 grid gap-y-4 lg:col-span-4">
        <div
             class="flex items-center py-3 text-sm text-gray-800 after:ms-6 after:flex-1 after:border-t after:border-gray-200">
          Penjamin</div>
        @foreach ($this->dataPenjamin as $penjamin)
          <!-- Card -->
          <div class="flex flex-col rounded-xl border bg-white shadow-sm">
            <div class="flex justify-between gap-x-3 p-4 md:p-5">
              <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">
                  Penjamin {{ $penjamin->parentPenjamin->nama_penjamin }}
                </p>
                <div class="mt-1 flex items-center gap-x-2">
                  <h3 class="text-xl font-medium text-gray-800 sm:text-2xl">
                    {{ SurveyPelanggan::where('penjamin_id', $penjamin->parentPenjamin->id)->where('layanan_id', $this->karyawanProfile->layanan_id)->where('karyawan_id', $this->karyawanProfile->id)->count() }}
                  </h3>
                  <span class="flex items-center gap-x-1 text-red-600">
                    <svg class="size-4 inline-block self-center"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                      <polyline points="22 17 13.5 8.5 8.5 13.5 2 7" />
                      <polyline points="16 17 22 17 22 11" />
                    </svg>
                    <span class="inline-block text-lg">
                      1.7%
                    </span>
                  </span>
                </div>
              </div>
              <div class="size-[46px] flex shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                <svg class="size-5 shrink-0"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                  <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                  <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                </svg>
              </div>
            </div>

            <a class="inline-flex items-center justify-between rounded-b-xl border-t border-gray-200 px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 focus:bg-gray-50 focus:outline-none md:px-5"
               href="#">
              View reports
              <svg class="size-4 shrink-0"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </a>
          </div>
          <!-- End Card -->
        @endforeach

      </div>
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Section -->

</section>
