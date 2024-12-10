<?php

use App\Models\{Layanan, Penjamin, LayananRespon, Respon};
use WireUi\Traits\WireUiActions;
use Illuminate\Support\Carbon;
use function Livewire\Volt\{uses, state, layout, title, mount, computed, on, updated, action, renderless, WireUiActions};

layout('components.layouts.home');
title('Halaman Survey Pasien');
uses([WireUiActions::class]);
state([
    'karyawanId' => Auth::user()->parentKaryawanProfile()->value('id'),
    'penjamin' => null,
    'namaLayanan' => null,
    'layananId' => null,
    'radioLayanan' => null,
    'selectRespon' => null,
    'stateRadio' => false,
    'hasNilai' => [],
    'dataNilai' => [],
    'stateRespon' => true,
    'stateQuestion' => false,
    'shift' => null,
]);
mount(function (LayananRespon $layananRespon) {
    $this->penjamin = Penjamin::where('nama_penjamin', request()->query('penjamin'))->get();
});
updated([
    'radioLayanan' => function () {
        $this->radioLayanan;
        $this->stateRadio = true;
        $this->stateRespon = true;
    },
]);
$layanan = computed(function () {
    return Layanan::where('multi_layanan', false)
        ->whereNotIn('id', $this->hasNilai)
        ->get();
});
$respon = computed(function () {
    return LayananRespon::with('parentRespon')
        ->join('respon', 'layanan_respon.respon_id', '=', 'respon.id')
        ->where('layanan_id', $this->radioLayanan)
        ->orderBy('respon.urutan_respon', 'ASC')
        ->get();
});
$kembali = action(fn() => to_route('home-idle'))->renderless();
$nilai = action(function () {
    $this->dialog()->confirm([
        'title' => 'Nilai',
        'description' => 'Beri Nilai',
        'icon' => 'question',
        'accept' => [
            'label' => 'Nilai',
            'method' => 'simpanNilai',
            'params' => [
                'layanan' => $this->radioLayanan,
                'respon' => $this->selectRespon,
            ],
        ],
        'reject' => [
            'label' => 'Batal',
        ],
    ]);
})->renderless();

$simpanNilai = action(function (array $data) {
    // $this->js('alert(' . $data['layanan'] . ')');
    $respon = Respon::find($data['respon']);
    if ($respon->has_question) {
        $this->stateQuestion = true;
    }
    $shiftHours = now()->hour;
    if ($shiftHours >= 7 && $shiftHours <= 15) {
        $this->shift = 'pagi';
    } elseif ($shiftHours >= 16 && $shiftHours <= 23) {
        $this->shift = 'siang';
    } else {
        $this->shift = 'malam';
    }
    $this->dataNilai[] = [
        'karyawan_id' => $this->karyawanId,
        'penjamin_id' => $this->penjamin->value('id'),
        'shift' => $this->shift,
        'layanan_id' => $data['layanan'],
        'nilai_skor' => Respon::find($data['respon'])->nama_respon,
        'survey_masuk' => Carbon::now(),
    ];
    array_push($this->hasNilai, $data['layanan']);

    // $this->dispatch('clear-layanan', radioLayanan: $data['layanan']);
    return $this->getNotification('info', 'Nilai', 'Nilai disimpan');
})->renderless();

$endNilai = action(function () {
    if ($this->stateQuestion) {
        return $this->dispatch('isiFormDataDiri');
    }
    $this->dialog()->confirm([
        'title' => 'Nilai',
        'description' => 'Akhiri Nilai Survey',
        'icon' => 'warning',
        'accept' => [
            'label' => 'selesai',
            'method' => 'endSurvey',
            'params' => [
                'dataNilai' => $this->dataNilai,
            ],
        ],
        'reject' => [
            'label' => 'Batal',
        ],
    ]);
})->renderless();

// on([
//     'endSurvey' => function ($dataNilai) {
//         dd($dataNilai);
//     },
// ]);

$endSurvey = function ($dataNilai) {
    // dd($dataNilai);
    $this->notification()->send([
        'icon' => 'success',
        'title' => 'Survey',
        'description' => 'Terimakasih telah mengisi survey',
        'onClose' => [
            'method' => 'kembali',
        ],
        'onDismiss' => [
            'method' => 'kembali',
        ],
        'onTimeout' => [
            'method' => 'kembali',
        ],
    ]);
};

// on([
//     'refresh-layanan' => function () {
//         $this->layanan();
//     },
// ]);

$refreshLayanan = function () {
    $this->stateRespon = false;
    $this->layanan();
};

$getNotification = function ($icon, $title, $desc) {
    $this->notification()->send([
        'icon' => $icon,
        'title' => $title,
        'description' => $desc,
        'onClose' => [
            'method' => 'refreshLayanan',
        ],
        'onDismiss' => [
            'method' => 'refreshLayanan',
        ],
        'onTimeout' => [
            'method' => 'refreshLayanan',
        ],
    ]);
};

?>

<section class="mx-auto">

  <div class="mx-auto my-auto max-w-max">
    <div class="flex flex-nowrap gap-4 border-b-2 pt-2">
      <div class="group block justify-center">
        <h1 class="align-middle font-bold uppercase sm:text-xl md:text-2xl lg:text-4xl">
          Survey Layanan @if ($this->radioLayanan !== null)
            {{ Layanan::find($this->radioLayanan)->nama_layanan }}
          @endif

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
      {{-- @if (count($this->dataNilai) > 0) --}}
      <div class="@if (count($this->dataNilai) > 0) group mx-auto @else hidden @endif">
        <button type="button"
                class="m-1 ms-0 inline-flex items-center gap-x-2 rounded-full border border-transparent bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                aria-haspopup="dialog"
                aria-expanded="false"
                aria-controls="hs-offcanvas-top"
                data-hs-overlay="#hs-offcanvas-top">
          Lihat Nilai
        </button>
      </div>
      {{-- @endif --}}
    </div>
  </div>

  <div class="mx-auto my-2 flex gap-x-2">
    <div class="grid h-72 w-64 grid-flow-row gap-y-2 overflow-y-scroll rounded-lg bg-gray-100 shadow">
      {{-- <form> --}}
      @foreach ($this->layanan as $l)
        <div class="px-3 py-2">
          <label
                 class="has-[:checked]:animate-pulse has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-300 flex flex-row items-stretch rounded-full border bg-white p-2">
            <div class="self-center">
              <x-wireui-radio id="layanan-id-{{ $l->id }}"
                              wire:model.change="radioLayanan"
                              wire:key="{{ uniqid() }}"
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
      @if ($this->stateRespon)
        @foreach ($this->respon as $r)
          <label
                 class="has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-200 has-[:checked]:outline-2 has-[:checked]:scale-90 has-[:checked]:rounded-2xl flex grow scale-95 animate-[wiggle_1s_ease-in-out_infinite] flex-col justify-stretch rounded-lg border text-center md:h-64 md:w-44 md:p-2">
            <livewire:survey.respon-card wire:key="{{ $r->id }}"
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
      @endif
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
    @if ($this->stateRadio)
      <div class="flex-grow">
        <x-wireui-button right-icon="pencil"
                         label="Nilai"
                         class="w-full"
                         wire:click="nilai"
                         interaction="info"
                         positive
                         rounded
                         lg />
      </div>
    @endif
    @if (count($this->hasNilai) > 1)
      <div class="flex-none place-content-center">
        <x-wireui-button icon="arrow-turn-down-right"
                         label="Akhiri"
                         class="w-full"
                         type="button"
                         wire:click="endNilai"
                         info
                         rounded />
      </div>
    @endif
  </div>

  <div id="hs-offcanvas-top"
       class="hs-overlay size-full fixed inset-x-0 top-0 z-[80] hidden max-h-40 -translate-y-full transform border-b bg-white transition-all duration-300 hs-overlay-open:translate-y-0 dark:border-neutral-700 dark:bg-neutral-800"
       role="dialog"
       tabindex="-1"
       aria-labelledby="hs-offcanvas-top-label">
    <div class="flex items-center justify-between border-b px-4 py-3 dark:border-neutral-700">
      <h3 id="hs-offcanvas-top-label"
          class="font-bold text-gray-800 dark:text-white">
        Anda Menilai
      </h3>
      <button type="button"
              class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
              aria-label="Close"
              data-hs-overlay="#hs-offcanvas-top">
        <span class="sr-only">Close</span>
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
          <path d="M18 6 6 18"></path>
          <path d="m6 6 12 12"></path>
        </svg>
      </button>
    </div>
    @if (count($this->dataNilai) > 0)
      <div class="grid grid-cols-6 gap-x-4 p-3">
        @foreach ($this->dataNilai as $n)
          <div>
            <p class="text-gray-800 dark:text-neutral-400">
              {{ Layanan::find($n['layanan_id'])->nama_layanan }}
            </p>
            <p class="text-gray-800 dark:text-neutral-400">
              {{ $n['nilai_skor'] }}
            </p>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</section>

@push('customScripts')
  <script type="module">
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();
      // Livewire.on('clear-layanan', async function(data) {
      //   // @this.layanan();
      //   // console.log(radioLayanan);
      //   // let idRadio = `layanan-id-${data.radioLayanan}`;
      //   // console.log(idRadio);
      //   // let radio = document.getElementById(idRadio);
      //   // // radio.checked = false;
      //   // // radio.style.display = 'none';
      //   $wireui.notify({
      //     title: 'Survey',
      //     // description: JSON.stringify(desc.message),
      //     description: 'berhasil menilai layanan',
      //     icon: 'info',
      //     onClose: () => Livewire.dispatch('refresh-layanan'),
      //     onDismiss: () => Livewire.dispatch('refresh-layanan'),
      //     onTimeout: () => Livewire.dispatch('refresh-layanan'),
      //   });
      // });
    });
  </script>
@endpush
