<?php

use function Livewire\Volt\{state, layout, title, mount, computed, on};
use App\Models\{Layanan, Penjamin, SurveyPelanggan, PenjaminLayanan, LayananRespon, Unit, Respon};
use Asantibanez\LivewireCharts\Models\{PieChartModel, ColumnChartModel, RadarChartModel};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

layout('components.layouts.office');
title('Halaman Grafik Survey Masuk (VP)');
state([
    'unitList' => null,
    'namaLayanan' => null,
    'namaPenjamin' => null,
    'isMultiLayanan' => false,
    'layanan' => null,
    'penjamin' => null,
    'layananRespon' => null,ww
    'jamDinding' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
    'mulaiPeriode' => Carbon::now()->subDays(84)->format('Y-m-d'),
    'akhirPeriode' => Carbon::now()->endOfDay()->format('Y-m-d'),
    'colors' => ['#F72C5B', '#A7D477', '#FF748B', '#E4F1AC', '#B1F0F7', '#81BFDA', '#F5F0CD', '#FADA7A'],
]);

mount(function () {
    $this->layanan = Layanan::all();
    $this->penjamin = PenjaminLayanan::with(['parentPenjamin'])
        ->where('layanan_id', $this->layanan->id)
        ->get();
    if (!$this->isMultiLayanan) {
        $this->layananRespon = LayananRespon::with(['parentRespon'])
            ->where('layanan_id', $this->layanan->id)
            ->get();
    } else {
        $this->layananRespon = LayananRespon::get()
            ->groupBy('layanan_id')
            ->toBase();
    }
});

$penjaminLayanan = computed(function () {
    $pieCharts = (new PieChartModel())->setTitle('Penjamin Layanan : ' . $this->layanan->nama_layanan);
    if (!$this->isMultiLayanan) {
        foreach ($this->penjamin as $key => $value) {
            $pieCharts->addSlice(
                $value->parentPenjamin->nama_penjamin,
                SurveyPelanggan::where('penjamin_id', $value->parentPenjamin->id)
                    ->where('layanan_id', $this->layanan->id)
                    ->where('karyawan_id', $this->karyawanId)
                    ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                    ->count(),
                // '#' . substr(uniqid(), -6),
                $this->colors[$key],
            );
        }
    } else {
        foreach ($this->penjamin as $key => $value) {
            $pieCharts->addSlice(
                $value->parentPenjamin->nama_penjamin,
                SurveyPelanggan::where('penjamin_id', $value->parentPenjamin->id)
                    ->where('karyawan_id', $this->karyawanId)
                    ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                    ->count(),
                $this->colors[$key],
            );
        }
    }
    return $pieCharts->withDataLabels()->setAnimated(true)->setDataLabelsEnabled(true)->asDonut();
});

$responChart = computed(function () {
    $columnCharts = new ColumnChartModel();
    if (!$this->isMultiLayanan) {
        $columnCharts->setTitle('Respon Layanan : ' . $this->layanan->nama_layanan);
        foreach ($this->layananRespon as $key => $value) {
            $columnCharts->addColumn(
                $value->parentRespon->nama_respon,
                SurveyPelanggan::where('nilai_skor', $value->parentRespon->nama_respon)
                    ->where('layanan_id', $this->layanan->id)
                    ->where('karyawan_id', $this->karyawanId)
                    ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                    ->count(),
                $value->parentRespon->tag_warna_respon,
            );
        }
    } else {
        foreach ($this->layananRespon as $key => $value) {
            $columnCharts->setTitle('Respon Layanan : ' . $value);
            foreach ($value as $key => $r) {
                $columnCharts->addColumn(
                    Respon::find($r->respon_id)->nama_respon . '(' . $r->layanan_id . ')',
                    SurveyPelanggan::where('nilai_skor', Respon::find($r->respon_id)->nama_respon)
                        ->where('karyawan_id', $this->karyawanId)
                        ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                        // ->groupBy('layanan_id')
                        ->count(),
                    Respon::find($r->respon_id)->tag_warna_respon,
                );
            }
        }
    }
    return $columnCharts->withDataLabels()->setAnimated(true)->setDataLabelsEnabled(true);
});

$responWaktu = computed(function () {
    $radarChartModel = (new RadarChartModel())->setTitle('Respon Layanan : ' . $this->layanan->nama_layanan);
    if (!$this->isMultiLayanan) {
        foreach ($this->jamDinding as $jam) {
            foreach ($this->layananRespon as $key => $value) {
                $radarChartModel->addSeries(
                    $value->parentRespon->nama_respon,
                    $jam . ':00',
                    SurveyPelanggan::where('nilai_skor', $value->parentRespon->nama_respon)
                        ->where('layanan_id', $this->layanan->id)
                        ->where('karyawan_id', $this->karyawanId)
                        // ->where(DB::raw('DATE_FORMAT(survey_masuk, '%H:$i')'), '=', Carbon::now()->subDays(7)->toDateTimeString())
                        ->where(function ($subTime) use ($jam) {
                            if ($jam === 24) {
                                // $subTime->whereTime('survey_masuk', '>=', $jam . ':00')->whereTime('survey_masuk', '<', '01:00');
                                $subTime->whereTime('survey_masuk', '>=', $jam . ':00');
                            }
                            $subTime->whereTime('survey_masuk', '>=', $jam . ':00')->whereTime('survey_masuk', '<', $jam + 1 . ':00');
                        })
                        ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                        // ->where(function ($subDate) {
                        // $subDate->where('created_at', (new Carbon())->subDays(30)->startOfDay()->toDateString(), (new Carbon())->now()->endOfDay()->toDateString());
                        // })
                        ->count(),
                );
            }
        }
    } else {
        foreach ($this->jamDinding as $jam) {
            foreach ($this->layananRespon as $key => $value) {
                $radarChartModel->addSeries(
                    $value->parentRespon->nama_respon,
                    $jam . ':00',
                    SurveyPelanggan::where('nilai_skor', $value->parentRespon->nama_respon)
                        ->where('karyawan_id', $this->karyawanId)
                        ->where(function ($subTime) use ($jam) {
                            if ($jam === 24) {
                                $subTime->whereTime('survey_masuk', '>=', $jam . ':00');
                            }
                            $subTime->whereTime('survey_masuk', '>=', $jam . ':00')->whereTime('survey_masuk', '<', $jam + 1 . ':00');
                        })
                        ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                        ->count(),
                );
            }
        }
    }
    return $radarChartModel->withDataLabels()->setAnimated(true);
});

on([
    'filterData' => function ($min, $max) {
        $this->mulaiPeriode = Carbon::parse($min)->format('Y-m-d');
        $this->akhirPeriode = $max;
        $this->penjaminLayanan();
    },
]);

?>

<section class="item s-start mx-auto flex h-screen flex-row flex-wrap justify-center gap-4 justify-self-stretch">

  <div class="inline-grid grid-cols-2 items-center gap-x-4 rounded-xl bg-white px-4 py-2 align-middle shadow">
    <h1 class="font-sans text-lg font-semibold">Periode Grafik</h1>
    <div class="inline-flex grow flex-row items-stretch gap-x-4">
      <input id="periodeTanggalMulai"
             type="text"
             class="w-full rounded-xl border-gray-300"
             placeholder="tanggal mulai">
      <div class="self-center">
        <span class="text-md font-mono">
          <svg xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round"
               class="lucide lucide-arrow-right size-4">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
          </svg>
        </span>
      </div>
      <input id="periodeTanggalAkhir"
             type="text"
             class="w-full rounded-xl border-gray-300"
             placeholder="tanggal akhir">
    </div>
  </div>

  <div class="inline-flex grow items-start gap-x-2 rounded-xl bg-white px-4 py-2 shadow">
    Data Survey diambil periode
    <span class="font-semibold">{{ $this->mulaiPeriode }}</span>
    sampai
    <span class="font-semibold">{{ $this->akhirPeriode }}</span>
  </div>

  <div class="h-full w-full rounded-xl border bg-white p-4 shadow">
    <livewire:livewire-pie-chart key="{{ $this->penjaminLayanan->reactiveKey() }}"
                                 :pie-chart-model="$this->penjaminLayanan" />
  </div>

  <div class="h-full w-full rounded-xl border bg-white p-4 shadow">
    <livewire:livewire-column-chart key="{{ $this->responChart->reactiveKey() }}"
                                    :column-chart-model="$this->responChart" />
  </div>
  @if (!$this->isMultiLayanan)
    <div class="h-full w-full rounded-xl border bg-white p-4 shadow">
      <livewire:livewire-radar-chart key="{{ $this->responWaktu->reactiveKey() }}"
                                     :radar-chart-model="$this->responWaktu" />
    </div>
  @endif

</section>

@push('customScripts')
  <script type="module">
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();
      let calendarMax = flatpickr("#periodeTanggalAkhir", {
        enableTime: false,
        dateFormat: "Y-m-d",
        maxDate: "today",
        onClose: function(selectedDates, dateStr, instance) {
          // console.log(calendarMin.selectedDates[0]);
          Livewire.dispatch('filterData', {
            max: dateStr,
            min: calendarMin.selectedDates[0],
          });
        }
      });
      let calendarMin = flatpickr("#periodeTanggalMulai", {
        enableTime: false,
        dateFormat: "Y-m-d",
        maxDate: "today",
        onClose: function(selectedDates, dateStr, instance) {
          calendarMax.clear();
          calendarMax.set({
            minDate: dateStr
          });
        }
      });
    });
  </script>
@endPush
