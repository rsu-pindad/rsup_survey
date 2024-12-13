<?php

use App\Models\{Layanan, Penjamin, LayananRespon, Respon};
use WireUi\Traits\WireUiActions;
use Illuminate\Support\Carbon;
use function Livewire\Volt\{rules, uses, state, layout, title, mount, computed, updated, action, renderless};

layout('components.layouts.home');
title('Halaman Survey Pasien');
uses([WireUiActions::class]);
state([
    'karyawanId' => Auth::user()->parentKaryawanProfile()->value('id'),
    'penjamin' => null,
    'radioLayanan' => null,
    'radioRespon' => null,
    'namaLayanan' => null,
    'hasNilai' => [],
    'dataNilai' => [],
    'stateRespon' => false,
    'stateReady' => false,
    'stateQuestion' => false,
    'shift' => null,
]);
rules([
    'radioLayanan' => 'required',
    'radioRespon' => 'required',
])->messages([
    'radioLayanan.required' => 'mohon pilih layanan',
    'radioRespon.required' => 'mohon pilih nilai',
]);
mount(function (LayananRespon $layananRespon) {
    $this->penjamin = Penjamin::where('nama_penjamin', request()->query('penjamin'))->get();
});
updated([
    'radioLayanan' => function () {
        $this->layanan();
        $this->stateRespon = true;
        // $this->stateReady = true;
        $this->namaLayanan = Layanan::find($this->radioLayanan)->nama_layanan;
    },
    'radioRespon' => function () {
        $this->stateReady = true;
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
    $this->validate();
    $this->dialog()->confirm([
        'title' => 'Nilai',
        'description' => '<span class="text-xl">Beri Nilai</span>',
        'icon' => 'question',
        'align' => 'center',
        'width' => 'sm',
        'accept' => [
            'label' => 'Nilai',
            'method' => 'simpanNilai',
            'color' => 'positive',
            'size' => 'xl',
            'params' => [
                'layanan' => $this->radioLayanan,
                'respon' => $this->radioRespon,
            ],
        ],
        'reject' => [
            'label' => 'Batal',
            'size' => 'xl',
            'color' => 'warning',
        ],
    ]);
})->renderless();
$simpanNilai = action(function (array $data) {
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
        'karyawan_id' => intval($this->karyawanId),
        'penjamin_id' => intval($this->penjamin->value('id')),
        'layanan_id' => intval($data['layanan']),
        'shift' => $this->shift,
        'nilai_skor' => Respon::find($data['respon'])->nama_respon,
        'survey_masuk' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
    array_push($this->hasNilai, $data['layanan']);

    $this->dispatch('clear-respon', id: $data['respon']);
    return $this->getNotification('info', 'Nilai', 'Nilai disimpan');
})->renderless();
$endNilai = action(function () {
    // if ($this->stateQuestion) {
    //   $this->js("alert('$this->stateQuestion')");
    //   // return $this->isiDataDiri();
    //     // return $this->dispatch('isi-form-data-diri', dataNilai: $this->dataNilai, stateQuestion: $this->stateQuestion);
    // }
    $this->dialog()->confirm([
        'title' => 'Nilai',
        'description' => 'Akhiri Nilai Survey',
        'icon' => 'warning',
        'accept' => [
            'label' => 'Selesai',
            'method' => 'questionSurvey',
            'color' => 'warning',
            'size' => 'xl',
        ],
        'reject' => [
            'label' => 'Batal',
            'color' => 'positive',
            'size' => 'xl',
        ],
    ]);
})->renderless();
$questionSurvey = action(function () {
    if ($this->stateQuestion) {
        return $this->isiDataDiri();
        // return $this->dispatch('isi-form-data-diri', dataNilai: $this->dataNilai, stateQuestion: $this->stateQuestion);
    }
    $this->dialog()->confirm([
        'title' => 'Data Diri',
        'description' => 'Isi data diri',
        'icon' => 'question',
        'accept' => [
            'label' => 'Isi data diri',
            'method' => 'isiDataDiri',
            'color' => 'info',
            'size' => 'xl',
            // 'params' => [
            //     'dataNilai' => $this->dataNilai,
            // ],
        ],
        'reject' => [
            'label' => 'Lewati',
            'color' => 'positive',
            'size' => 'xl',
            'method' => 'skipQuestionState',
        ],
    ]);
})->renderless();
$isiDataDiri = function () {
    $this->dispatch('isi-form-data-diri', dataNilai: $this->dataNilai, stateQuestion: $this->stateQuestion);
};
$skipQuestionState = function () {
    $this->dispatch('skip-question-state', dataNilai: $this->dataNilai, stateQuestion: $this->stateQuestion);
};
// $endSurvey = function ($dataNilai) {
//     $this->notification()->send([
//         'icon' => 'success',
//         'title' => 'Survey',
//         'description' => 'Terimakasih telah mengisi survey',
//         'onClose' => [
//             'method' => 'kembali',
//         ],
//         'onDismiss' => [
//             'method' => 'kembali',
//         ],
//         'onTimeout' => [
//             'method' => 'kembali',
//         ],
//     ]);
// };
$refreshLayanan = function () {
    $this->stateRespon = false;
    $this->stateReady = false;
    $this->layanan();
};
$getNotification = function ($icon, $title, $desc) {
    if (count($this->layanan) === 0) {
        // return $this->dispatch('end-survey');
        return $this->questionSurvey();
    }
    $this->notification()->send([
        'icon' => $icon,
        'title' => $title,
        'description' => $desc,
        'timeout' => 1200,
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
    <div class="flex flex-nowrap gap-x-4 border-b-2 py-1 uppercase">
      <div class="group justify-center align-middle text-2xl">
        <h1 class="font-bold"
            x-data="{
                open: $wire.entangle('stateRespon').live,
                names: $wire.entangle('namaLayanan').live
            }">
          Survey Layanan
          <template x-if="open">
            <span x-text="names"></span>
          </template>
        </h1>
        <h1 class="font-semibold">
          Penjamin {{ $this->penjamin->value('nama_penjamin') }}
        </h1>
      </div>
      <div class="group my-auto justify-center text-center align-middle text-xl">
        <h1 class="font-semibold">
          Waktu Survey
        </h1>
        <h1 id="waktuSurvey"
            x-data
            x-timeout:1000="$el.innerText=$moment().format('HH:mm:ss')"
            class="font-bold">
        </h1>
      </div>
      <div class="@if (count($this->dataNilai) > 0) justify-center align-middle my-auto group @else hidden @endif">
        <button type="button"
                class="inline-flex items-center gap-x-2 rounded-full border border-transparent bg-lime-600 p-2 hover:bg-lime-700 focus:bg-lime-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                aria-haspopup="dialog"
                aria-expanded="false"
                aria-controls="hs-offcanvas-top"
                data-hs-overlay="#hs-offcanvas-top">
          Lihat Nilai
        </button>
      </div>
    </div>
  </div>

  <div class="mx-auto my-2 flex gap-x-2">
    @if (count($this->layanan) !== 0)
      <div
           class="grid h-72 w-64 grid-flow-row gap-y-2 overflow-y-scroll rounded-lg bg-gray-50 uppercase shadow ring-1 ring-lime-300">
        @foreach ($this->layanan as $l)
          <div class="px-3 py-2 font-sans font-semibold">
            <label
                   class="has-[:checked]:scale-95 has-[:checked]:animate-pulse has-[:checked]:bg-lime-100 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-300 flex flex-row items-stretch rounded-full border bg-white px-2 py-3">
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
              <div class="justify-evenly self-center">
                <h1 class="ml-4 mr-auto text-2xl">{{ $l->nama_layanan }}</h1>
              </div>
            </label>
          </div>
        @endforeach

      </div>
      <div class="grow">
        <div class="grid h-72 grid-flow-col content-center overflow-x-scroll">
          @if ($this->stateRespon)
            @foreach ($this->respon as $r)
              <label
                     class="has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-200 has-[:checked]:outline-2 has-[:checked]:scale-90 has-[:checked]:rounded-2xl flex scale-95 flex-col justify-stretch rounded-xl border text-center md:h-auto md:w-44 md:p-2">
                <livewire:survey.respon-card wire:key="{{ $r->id }}"
                                             :colorText="$r->parentRespon->tag_warna_respon"
                                             :namaRespon="$r->parentRespon->nama_respon"
                                             :iconRespon="$r->parentRespon->icon_respon" />
                <div class="mt-auto place-items-center">
                  <x-wireui-radio id="wireui-respon-{{ $r->id }}"
                                  class="has-[:checked]:animate-ping"
                                  value="{{ $r->parentRespon->id }}"
                                  wire:key="{{ $r->parentRespon->id }}"
                                  wire:model.live="radioRespon"
                                  with-validation-colors
                                  positive
                                  lg />
                </div>
              </label>
            @endforeach
          @else
            <div class="items-stretch text-center">
              <h1 class="self-center font-serif text-5xl font-light uppercase">Mohon Pilih Layanan</h1>
            </div>
          @endif
        </div>
      </div>
    @else
      <div class="items-stretch text-center">
        <h1 class="self-center font-serif text-5xl font-light uppercase">Terimakasih, Anda sudah menilai layanan</h1>
      </div>
    @endif
  </div>

  <div class="fixed bottom-0 left-0 right-0 flex max-w-full flex-nowrap gap-x-4 px-6 py-2"
       x-data="{ open: $wire.entangle('stateReady').live }">
    <div class="flex-none place-content-center">
      <x-wireui-button icon="arrow-left"
                       label="Kembali"
                       class="w-full px-6"
                       type="button"
                       wire:click="kembali"
                       wire:loading.attr="disabled"
                       secondary
                       rounded
                       md />
    </div>
    <template class="flex-grow"
              x-if="open">
      <x-wireui-button right-icon="pencil"
                       label="Nilai"
                       class="w-full"
                       wire:click="nilai"
                       wire:loading.attr="disabled"
                       interaction="info"
                       positive
                       rounded
                       lg />
    </template>
    @if (count($this->hasNilai) > 0)
      <div class="flex-none place-content-center">
        <x-wireui-button right-icon="arrow-turn-down-right"
                         label="Selesai"
                         class="w-full px-6"
                         type="button"
                         wire:click="endNilai"
                         wire:loading.attr="disabled"
                         info
                         rounded
                         md />
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

  <livewire:survey.respon-question-multi-modal :dataNilai="$this->dataNilai"
                                               :stateQuestion="$this->stateQuestion" />

</section>

@push('customScripts')
  <script type="module">
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();

      function endPage() {
        location.href = '/';
      }

      Livewire.on('clear-respon', async function(data) {
        let idRadioRespon = `wireui-respon-${data.id}`;
        let radio = document.getElementById(idRadioRespon);
        if (radio !== null) {
          radio.checked = false;
        }
        @this.radioRespon = null;
      });

      Livewire.on('isi-form-data-diri', async function(data) {
        console.log(data);

        $openModal('modalPasien');
      });

      Livewire.on('end-survey', async function(data) {
        let pesan = data;

        @this.stateRespon = false;
        @this.stateReady = false;
        @this.refreshLayanan();
        // $wireui.notify({
        //   title: 'Survey',
        //   description: pesan.desc,
        //   icon: pesan.icons,
        //   onClose: () => endPage(),
        //   onDismiss: () => endPage(),
        //   onTimeout: () => endPage(),
        // });
        $closeModal('modalPasien');
        $wireui.dialog({
          icon: pesan.icons,
          title: 'Survey',
          description: pesan.desc,
          onClose: () => endPage(),
          onDismiss: () => endPage(),
          // onTimeout: () => endPage(),
        })
      });
    });
  </script>
@endpush
