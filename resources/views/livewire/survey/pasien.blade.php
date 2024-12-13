<?php

use App\Models\{Layanan, LayananRespon, Penjamin, Respon};
use App\Livewire\Survey\ResponQuestionModal;
use function Livewire\Volt\{state, mount, layout, title, action, on, locked, computed, rules};
layout('components.layouts.home');
title('Halaman Survey Pasien');
state(['selectRespon' => null, 'hookNameRespon' => null, 'penjamin' => null]);
state(['layanan' => Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->nama_layanan])->locked();
mount(function (LayananRespon $layananRespon) {
    $this->penjamin = Penjamin::where('nama_penjamin', request()->query('penjamin'))->get();
    // $this->respon = $layananRespon
    //     ->with('parentRespon')
    //     ->join('respon', 'layanan_respon.respon_id', '=', 'respon.id')
    //     ->where('layanan_id', Auth::user()->parentKaryawanProfile()->value('layanan_id'))
    //     ->orderBy('respon.urutan_respon', 'ASC')
    //     ->get();
});
$respon = computed(function () {
    return LayananRespon::with('parentRespon')
        ->join('respon', 'layanan_respon.respon_id', '=', 'respon.id')
        ->where('layanan_id', Auth::user()->parentKaryawanProfile()->value('layanan_id'))
        ->orderBy('respon.urutan_respon', 'ASC')
        ->get();
});
rules(['selectRespon' => 'required'])->messages([
    'selectRespon.required' => 'mohon pilih respon',
]);
$kembali = action(fn() => to_route('home-idle'))->renderless();
$nilai = action(function () {
    // $this->respon();
    // $this->validate();
    // $this->hookNameRespon = Respon::find($this->selectRespon)->nama_respon;
    // return $this->dispatch('respon-nilai');
    $this->dispatch('respon-check');
})->renderless();

on([
    'respon-check' => function () {
        $this->validate();
        $this->hookNameRespon = Respon::find($this->selectRespon)->nama_respon;
        return $this->dispatch('respon-nilai');
    },
]);

on([
    'nilai-layanan-pending' => function ($preResponId) {
        if (Respon::find($preResponId)->has_question === true) {
            $this->dispatch('opening-modal', responId: $preResponId, penjaminData: $this->penjamin->first()->id)->to(ResponQuestionModal::class);
            return $this->dispatch('open-modal-respon');
        }
        return $this->dispatch('respon-question-self');
    },
]);

on([
    'opening-modal-livewire' => function ($responId) {
        $this->dispatch('opening-modal-noquestion', skipQuestion: true, responId: $responId, penjaminData: $this->penjamin->first()->id)->to(ResponQuestionModal::class);
        return $this->dispatch('open-modal-respon');
    },
]);

on([
    'skip-question' => function ($skipQuestion, $respon) {
        return $this->dispatch('skip-question-insert', skipQuestion: $skipQuestion, respon: $respon, penjaminData: $this->penjamin->first()->id)->to(ResponQuestionModal::class);
    },
]);

?>

<section class="mx-auto">
  <!-- Icon Blocks -->
  <div class="mx-auto my-auto max-w-max">
    <div class="flex flex-nowrap gap-4 border-b-2 pt-2">
      <div class="group block justify-center">
        <h1 class="align-middle font-bold uppercase sm:text-xl md:text-2xl lg:text-4xl">
          Survey Layanan {{ $this->layanan }}
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
    <!-- Grid -->
    <form class="flex flex-nowrap place-content-center gap-x-4 py-2">
      <!-- Icon Block -->
      {{-- <div class=""> --}}
      <div class="flex flex-row gap-x-4 gap-y-2 overflow-x-scroll"
           wire:loading>
        {{-- wire:key="{{ $r->parentRespon->id }}"> --}}
        @foreach ($this->respon as $r)
          <label wire:loading.remove
                 class="has-[:checked]:bg-lime-50 has-[:checked]:text-lime-900 has-[:checked]:ring-lime-200 has-[:checked]:outline-2 has-[:checked]:scale-90 has-[:checked]:rounded-2xl flex grow animate-[wiggle_1s_ease-in-out_infinite] flex-col justify-stretch rounded-lg border p-2 text-center md:h-64 md:w-56 md:p-2">
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
      {{-- </div> --}}
      <!-- End Icon Block -->

    </form>
    <!-- End Grid -->
    {{-- <div class="flex flex-nowrap gap-4 pb-2"> --}}
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
  </div>
  <!-- End Icon Blocks -->

  <livewire:survey.respon-question-modal :respon="$this->selectRespon" />

</section>

@push('customScripts')
  <script type="module">
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();

      Livewire.on('respon-nilai', async function() {
        let layananNama = await @this.layanan;
        let responNama = await @this.hookNameRespon;
        let responId = await @this.selectRespon;
        $wireui.dialog({
          title: `Nilai Layanan ${layananNama}`,
          description: `<span class="text-xl">Anda menilai <span class="text-2xl font-bold uppercase">${responNama}</span></span>`,
          icon: 'question',
          accept: {
            label: 'Nilai',
            color: 'positive',
            width: '2xl',
            execute: () => Livewire.dispatch('nilai-layanan-pending', {
              preResponId: responId,
            }),
          },
          reject: {
            label: 'Batal',
            color: 'negative',
            width: '2xl',
            execute: () => Livewire.dispatch('$refresh')
          }
        });
      });

      Livewire.on('respon-question-self', async function() {
        let layananNama = await @this.layanan;
        let responNama = await @this.hookNameRespon;
        let idRespon = await @this.selectRespon;
        let penjaminId = await @this.penjamin;
        $wireui.dialog({
          title: `Respon Data Diri`,
          description: `<span class="text-xl">Apakah bersedia isi data diri ?`,
          icon: 'question',
          accept: {
            label: 'Isi Data',
            color: 'positive',
            width: '2xl',
            execute: () => Livewire.dispatch('opening-modal-livewire', {
              skipQuestion: true,
              responId: idRespon,
            }),
          },
          reject: {
            label: 'Lewati',
            color: 'warning',
            width: '2xl',
            execute: () => Livewire.dispatch('skip-question', {
              skipQuestion: true,
              respon: idRespon,
            })
          }
        });
      });

      Livewire.on('open-modal-respon', async function() {
        let responId = await @this.selectRespon;
        $openModal('modalPasien');
      });

      Livewire.on('nilai-layanan-final', async function(message, icons) {
        // setTimeout(notificationSurvey, 5000);
        $closeModal('modalPasien');
        await notificationSurvey(message, icons);
        setTimeout(reloadPage, 3000);
        // location.href = '/';
      });

      function reloadPage() {
        location.href = '/';
      }

      function notificationSurvey(desc, icons) {
        $wireui.notify({
          title: 'Survey',
          description: JSON.stringify(desc.message) + `\n Halaman akan dimuat kembali`,
          icon: 'info',
          onClose: () => reloadPage(),
          onDismiss: () => reloadPage(),
          onTimeout: () => reloadPage()
        });
      }

    });
  </script>
@endpush
