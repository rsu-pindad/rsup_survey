<?php

use Carbon\CarbonPeriod;
use App\Models\{Layanan, Unit, SurveyPelanggan, Penjamin};
use Illuminate\Support\{Collection, Carbon, Arr, Str};
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Support\Facades\DB;
use function Livewire\Volt\{layout, title, state, computed, mount, locked, on};
layout('components.layouts.office');
title('Halaman Survey Masuk');
state([
    'dataLayanan' => Layanan::get(),
])->locked();
state([
    'selectLayanan' => null,
    'jumlahMasukPerHari' => 0,
    'jumlahMasukPerMinggu' => 0,
    'jumlahMasukPerBulan' => 0,
    'penjaminData' => Penjamin::select(['id', 'nama_penjamin'])->get(),
    // 'totalSurveyMasuk' => 0,
]);

mount(function () {
    $this->jumlahMasukPerHari = DB::table('survey_pelanggan')->whereDate('survey_masuk', Carbon::today())->count();
    $this->jumlahMasukPerMinggu = DB::table('survey_pelanggan')
        ->whereBetween('survey_masuk', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])
        ->count();
    // $this->jumlahMasukPerBulan = DB::table('survey_pelanggan')->whereBetween('survey_masuk', '<=', Carbon::today()->endOfWeek())->count();
});

$chartSurveyDay = computed(function () {
    $start = Carbon::today()->startOfDay();
    $end = Carbon::today()->endOfDay();
    $periode = CarbonPeriod::create($start, '1 day', $end);

    $surveyMasukPerHari = collect($periode)->map(function ($date) {
        $endDate = $date->copy()->endOfDay();
        return [
            'count' => DB::table('survey_pelanggan')->whereDate('survey_masuk', $endDate)->selectRaw('HOUR(survey_masuk) as jam, COUNT(*) as jumlah')->groupByRaw('HOUR(survey_masuk)')->orderByRaw('HOUR(survey_masuk)')->get()->toArray(),
        ];
    });

    $data = Arr::flatten($surveyMasukPerHari->pluck('count'));
    $newData = json_decode(json_encode($data), true);
    $hours = [['jam' => 0, 'jumlah' => 0], ['jam' => 1, 'jumlah' => 0], ['jam' => 2, 'jumlah' => 0], ['jam' => 3, 'jumlah' => 0], ['jam' => 4, 'jumlah' => 0], ['jam' => 5, 'jumlah' => 0], ['jam' => 6, 'jumlah' => 0], ['jam' => 7, 'jumlah' => 0], ['jam' => 8, 'jumlah' => 0], ['jam' => 9, 'jumlah' => 0], ['jam' => 10, 'jumlah' => 0], ['jam' => 11, 'jumlah' => 0], ['jam' => 12, 'jumlah' => 0], ['jam' => 13, 'jumlah' => 0], ['jam' => 14, 'jumlah' => 0], ['jam' => 15, 'jumlah' => 0], ['jam' => 16, 'jumlah' => 0], ['jam' => 17, 'jumlah' => 0], ['jam' => 18, 'jumlah' => 0], ['jam' => 19, 'jumlah' => 0], ['jam' => 20, 'jumlah' => 0], ['jam' => 21, 'jumlah' => 0], ['jam' => 22, 'jumlah' => 0], ['jam' => 23, 'jumlah' => 0]];
    $combined = [];
    foreach (array_merge($hours, $newData) as $item) {
        if (isset($combined[$item['jam']])) {
            // $combined[$item['jam']]['jumlah'] = $item['jumlah']; // Merge the values
            $combined[$item['jam']]['x'] = Carbon::today()
                ->timezone('Asia/Jakarta')
                ->addHour($item['jam'])
                ->toAtomString();
            $combined[$item['jam']]['y'] = $item['jumlah'];
        } else {
            // $combined[$item['jam']] = $item;
            $combined[$item['jam']]['x'] = Carbon::today()
                ->timezone('Asia/Jakarta')
                ->addHour($item['jam'])
                ->toAtomString();
            $combined[$item['jam']]['y'] = $item['jumlah'];
        }
    }

    $jam = Arr::pluck($combined, 'jam');
    $jumlah = Arr::pluck($combined, 'jumlah');
    return Chartjs::build()
        ->name('SurveyMasukPerHari')
        ->type('line')
        ->size(['width' => 'auto', 'height' => 80])
        ->datasets([
            [
                'label' => Carbon::today()->locale('id')->isoFormat('dddd, D MMMM YYYY'),
                'backgroundColor' => 'rgba(60,20,100,0.5)',
                'borderColor' => 'rgba(60,20,100,0.7)',
                'data' => $combined,
            ],
        ])
        ->options([
            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'hour', // Show hourly data
                        'tooltipFormat' => 'l HH:mm', // Date format for the tooltip
                        'unitStepSize' => 1, // Each step represents one hour
                        'displayFormats' => [
                            'hour' => 'HH', // Display time as HH:mm (24-hour format)
                        ],
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Survey Masuk',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ]);
});

$chartSurveyWeek = computed(function () {
    $start = Carbon::today()->startOfWeek();
    $end = Carbon::today()->endOfWeek();
    $periode = CarbonPeriod::create($start, $end);

    $surveyMasukPerMinggu = collect($periode)->map(function ($date) {
        $startDate = $date->copy()->startOfDay();
        $endDate = $date->copy()->endOfDay();
        return [
            'count' => SurveyPelanggan::where('survey_masuk', '>=', $startDate)->where('survey_masuk', '<=', $endDate)->count(),
            'week' => $date->copy()->endOfDay()->format('Y-m-d'),
        ];
    });

    $data = $surveyMasukPerMinggu->pluck('count')->toArray();
    $labels = $surveyMasukPerMinggu->pluck('week')->toArray();
    $awalPekan = Carbon::today()->startOfWeek()->locale('id')->isoFormat('D');
    $akhirPekan = Carbon::today()->endOfWeek()->locale('id')->isoFormat('D MMMM YYYY');

    return Chartjs::build()
        ->name('SurveyMasukPerMinggu')
        ->type('line')
        ->size(['width' => 'auto', 'height' => 80])
        ->labels($labels)
        ->datasets([
            [
                'label' => $awalPekan . ' - ' . $akhirPekan,
                'backgroundColor' => 'rgba(60,20,100,0.5)',
                'borderColor' => 'rgba(60,20,100,0.7)',
                'data' => $data,
            ],
        ])
        ->options([
            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'day',
                    ],
                    'min' => $start->format('Y-m-d'),
                ],
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Survey Masuk Per Minggu',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ]);
});

$chartSurveyWeekCustom = computed(function ($id, $nama) {
    $idPenjamin = $id;
    $namaPenjamin = Str::of($nama)->squish();
    $namaPenjaminId = 'SurveyMasukPerMinggu' . $namaPenjamin;
    // dd($namaPenjamin);

    $start = Carbon::today()->startOfWeek();
    $end = Carbon::today()->endOfWeek();
    $periode = CarbonPeriod::create($start, $end);

    $surveyMasukPerMinggu = collect($periode)->map(function ($date) use ($idPenjamin) {
        $startDate = $date->copy()->startOfDay();
        $endDate = $date->copy()->endOfDay();
        return [
            'count' => SurveyPelanggan::where('penjamin_id', $idPenjamin)->where('survey_masuk', '>=', $startDate)->where('survey_masuk', '<=', $endDate)->count(),
            'week' => $date->copy()->endOfDay()->format('Y-m-d'),
        ];
    });

    $data = $surveyMasukPerMinggu->pluck('count')->toArray();
    $labels = $surveyMasukPerMinggu->pluck('week')->toArray();
    $awalPekan = Carbon::today()->startOfWeek()->locale('id')->isoFormat('D');
    $akhirPekan = Carbon::today()->endOfWeek()->locale('id')->isoFormat('D MMMM YYYY');

    return Chartjs::build()
        ->name($namaPenjaminId)
        ->type('bar')
        ->size(['width' => 'auto', 'height' => 80])
        ->labels($labels)
        ->datasets([
            [
                'label' => $namaPenjamin . ' - ' . $awalPekan . ' - ' . $akhirPekan,
                'backgroundColor' => 'rgba(60,20,100,0.5)',
                'borderColor' => 'rgba(60,20,100,0.7)',
                'data' => $data,
            ],
        ])
        ->options([
            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'day',
                    ],
                    'min' => $start->format('Y-m-d'),
                ],
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Survey Masuk Per Minggu ' . $namaPenjamin,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ]);
});

$chartSurveyMonth = computed(function () {
    $start = Carbon::parse(SurveyPelanggan::min('survey_masuk'));
    $end = Carbon::now();
    $periode = CarbonPeriod::create($start, '1 month', $end);

    $surveyMasukPerBulan = collect($periode)->map(function ($date) {
        $endDate = $date->copy()->endOfMonth();

        return [
            'count' => SurveyPelanggan::where('survey_masuk', '<=', $endDate)->count(),
            'month' => $endDate->format('Y-m-d'),
        ];
    });
    // dd($surveyMasukPerBulan);

    $data = $surveyMasukPerBulan->pluck('count')->toArray();
    $labels = $surveyMasukPerBulan->pluck('month')->toArray();

    return Chartjs::build()
        ->name('SurveyMasukPerBulan')
        ->type('line')
        ->size(['width' => 'auto', 'height' => 80])
        ->labels($labels)
        ->datasets([
            [
                'label' => 'Survey Masuk Sampai ' . Carbon::today()->locale('id')->isoFormat('D MMMM YYYY'),
                'backgroundColor' => 'rgba(40,50,20,0.5)',
                'borderColor' => 'rgba(40,50,20,0.7)',
                'data' => $data,
            ],
        ])
        ->options([
            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'month',
                    ],
                    'min' => $start->format('Y-m-d'),
                ],
            ],
            // 'plugins' => [
            //     'title' => [
            //         'display' => true,
            //         'text' => 'Survey Masuk Per Bulan',
            //     ],
            // ],
        ]);
});

?>

<section>

  <div class="grid grid-flow-row auto-rows-max gap-4">

    <!-- Card -->
    <div class="flex min-h-full flex-col rounded-xl border bg-white p-4 shadow-sm md:p-5">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500">
            Survey Masuk
          </h2>
          <p class="text-xl font-medium text-gray-800 sm:text-2xl">
            {{ $this->jumlahMasukPerHari }}
          </p>
        </div>

      </div>
      <!-- End Header -->

      <x-chartjs-component wire:key="{{ uniqid() }}"
                           :chart="$this->chartSurveyDay" />
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex min-h-full flex-col rounded-xl border bg-white p-4 shadow-sm md:p-5">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500">
            Survey Masuk
          </h2>
          <p class="text-xl font-medium text-gray-800 sm:text-2xl">
            {{ $this->jumlahMasukPerMinggu }}
          </p>
        </div>

      </div>
      <!-- End Header -->

      <x-chartjs-component wire:key="{{ uniqid() }}"
                           :chart="$this->chartSurveyWeek" />
    </div>
    <!-- End Card -->
    <div class="max-w-auto max-h-auto flex flex-col rounded-xl border bg-white p-4 shadow-sm md:p-5">
      @foreach ($this->penjaminData as $penjamin)
        <x-chartjs-component wire:key="{{ uniqid() }}"
                             :chart="$this->chartSurveyWeekCustom(
                                 $penjamin->id,
                                 Str::of($penjamin->nama_penjamin)->squish(),
                             )" />
      @endforeach
    </div>

    <!-- Card -->
    <div class="flex min-h-full flex-col rounded-xl border bg-white p-4 shadow-sm md:p-5">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-sm text-gray-500">
            {{-- Total Survey Masuk --}}
          </h2>
          <p class="text-xl font-medium text-gray-800 sm:text-2xl">
          </p>
        </div>

      </div>
      <!-- End Header -->

      <x-chartjs-component wire:key="{{ uniqid() }}"
                           :chart="$this->chartSurveyMonth" />
    </div>
    <!-- End Card -->
  </div>
  {{-- <canvas wire:ignore id="SurveyMasukPerBulan"></canvas> --}}

</section>

@push('customScripts')
  <script type="module">
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();

      //   var ctx = document.getElementById('SurveyMasukPerBulan');
      //   var myChart = new Chart(ctx, {
      //     // type: 'bar',
      //     @this.chartSurvey,
      //   });

    });
  </script>
@endpush
