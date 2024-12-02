<?php

use function Livewire\Volt\{state, layout, title, mount, computed};
use App\Models\{Layanan, Penjamin, SurveyPelanggan, PenjaminLayanan, LayananRespon};
use Asantibanez\LivewireCharts\Models\{PieChartModel, ColumnChartModel, RadarChartModel};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

// $layananData = fn() => $this->layanan++;
// $penjaminData = fn() => $this->penjamin++;

// $surveyMasuk = computed(
//     fn() => (new PieChartModel())
//         ->setTitle('Survey Masuk Layanan : ' . $this->layanan->nama_layanan)
//         // ->addSlice('Layanan', $this->layanan, '#f6ad55')
//         ->addSlice('Penjamin', $this->penjamin, '#fc8181'),
// );

layout('components.layouts.office');
title('Halaman Survey Masuk');
state([
    'karyawanId' => Auth::user()->parentKaryawanProfile()->value('id'),
    'namaLayanan' => null,
    'namaPenjamin' => null,
    'layanan' => null,
    'penjamin' => null,
    'layananRespon' => null,
    'jamDinding' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
    'mulaiPeriode' => Carbon::now()->subDays(84)->toDateTimeString(),
    'akhirPeriode' => Carbon::now()->endOfDay()->toDateTimeString(),
]);

mount(function () {
    $this->layanan = Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'));
    $this->penjamin = PenjaminLayanan::with(['parentPenjamin'])
        ->where('layanan_id', $this->layanan->id)
        ->get();
    $this->layananRespon = LayananRespon::with(['parentRespon'])
        ->where('layanan_id', $this->layanan->id)
        ->get();
    // dd(Carbon::now()->format('Y-m-d H:i'));
});

$penjaminLayanan = computed(function () {
    $pieCharts = (new PieChartModel())->setTitle('Penjamin Layanan : ' . $this->layanan->nama_layanan . ' / ' . Str::upper(Auth()->user()->parentKaryawanProfile()->value('nama_karyawanprofile')) . ' / ' . $this->mulaiPeriode . ' - ' . $this->akhirPeriode);
    foreach ($this->penjamin as $key => $value) {
        $pieCharts->addSlice(
            $value->parentPenjamin->nama_penjamin,
            SurveyPelanggan::where('penjamin_id', $value->parentPenjamin->id)
                ->where('layanan_id', $this->layanan->id)
                ->where('karyawan_id', $this->karyawanId)
                ->whereBetween('survey_masuk', [$this->mulaiPeriode, $this->akhirPeriode])
                ->count(),
            '#' . substr(uniqid(), -6),
        );
    }
    $pieCharts
        ->withDataLabels()
        ->setAnimated(true)
        ->setDataLabelsEnabled(true)
        ->asDonut();
    return $pieCharts;
});

$responChart = computed(function () {
    $columnCharts = (new ColumnChartModel())->setTitle('Respon Layanan : ' . $this->layanan->nama_layanan . ' / ' . Str::upper(Auth()->user()->parentKaryawanProfile()->value('nama_karyawanprofile')) . ' / ' . $this->mulaiPeriode . ' - ' . $this->akhirPeriode);

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
    $columnCharts->withDataLabels()->setAnimated(true)->setDataLabelsEnabled(true);
    return $columnCharts;
});

$responWaktu = computed(function () {
    $radarChartModel = (new RadarChartModel())->setTitle('Respon Layanan : ' . $this->layanan->nama_layanan . ' / ' . Str::upper(Auth()->user()->parentKaryawanProfile()->value('nama_karyawanprofile')) . ' / ' . $this->mulaiPeriode . ' - ' . $this->akhirPeriode);
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
                            $subTime->whereTime('survey_masuk', '>=', $jam . ':00')->whereTime('survey_masuk', '<', '01:00');
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
    $radarChartModel->withDataLabels()->setAnimated(true)->setDataLabelsEnabled(true);
    return $radarChartModel;
});

?>

<section class="item s-start mx-auto flex h-screen flex-row flex-wrap justify-center gap-4 justify-self-stretch">

  <div class="h-full w-full rounded border bg-white p-4 shadow">
    <livewire:livewire-pie-chart key="{{ $this->penjaminLayanan->reactiveKey() }}"
                                 :pie-chart-model="$this->penjaminLayanan" />
  </div>
  <div class="h-full w-full rounded border bg-white p-4 shadow">
    <livewire:livewire-column-chart key="{{ $this->responChart->reactiveKey() }}"
                                    :column-chart-model="$this->responChart" />
  </div>

  <div class="h-full w-full rounded border bg-white p-4 shadow">
    <livewire:livewire-radar-chart key="{{ $this->responWaktu->reactiveKey() }}"
                                   :radar-chart-model="$this->responWaktu" />
  </div>

</section>
