<?php

namespace App\Livewire\PowerGrid\Admin;

use App\Enums\Nilai;
use App\Enums\Shift;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\Penjamin;
use App\Models\SurveyPelanggan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class SurveyTabel extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public string $tableName = 'survey_pelanggan';

    public bool $deferLoading = false;
    public string $strRandom  = '';
    public bool $showFilters  = true;

    public function hydrate(): void
    {
        sleep(1);
    }

    protected function queryString(): array
    {
        return [
            'search' => ['except' => ''],
            // 'page' => ['except' => 1],
            ...$this->powerGridQueryString(),
        ];
    }

    public function setUp(): array
    {
        $this->strRandom = Str::random(4);

        return [
            Exportable::make('export_survey_pelanggan' . Carbon::now()->format('Y-M-d_') . $this->strRandom)
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->csvSeparator(',')
                ->csvDelimiter('"'),
            Header::make()
                ->showToggleColumns()
                ->withoutLoading(),
            Footer::make()
                ->pageName('surveyPelangganPage')
                ->showPerPage(perPageValues: [25, 50, 100])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $idKaryawan = Auth::user()->parentKaryawanProfile->karyawan_id;
        // dd($karyawanId->id);
        // dd(Auth::user()->getRoleNames('employee'));
        if (Auth::user()->hasRole('employee')) {
            $karyawanId = KaryawanProfile::where('karyawan_id', $idKaryawan)->first();

            return SurveyPelanggan::query()->where('karyawan_id', $karyawanId->id)->orderBy('survey_masuk', 'DESC');
        } else {
            return SurveyPelanggan::query();
        }
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
                   ->add('id')
                   ->add('karyawan_id')
                   ->add('karyawan_label', function ($query) {
                       return $query->parentKaryawan->nama_karyawanprofile ?? '-';
                   })
                   ->add('penjamin_id')
                   ->add('penjamin_label', function ($query) {
                       return $query->parentPenjamin->nama_penjamin ?? '-';
                   })
                   ->add('layanan_id')
                   ->add('layanan_label', function ($query) {
                       return $query->parentLayanan->nama_layanan ?? '-';
                   })
                   ->add('nama_pelanggan')
                   ->add('handphone_pelanggan')
                   ->add('shift')
                   ->add('nilai_skor')
                   ->add('survey_masuk_format_bulan', fn(SurveyPelanggan $model) => Carbon::parse($model->survey_masuk)->format('d/m/Y'));
        //    ->add('survey_masuk_format_jam', fn(SurveyPelanggan $model)   => Carbon::parse($model->survey_masuk)->format('H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: true)
                ->visibleInExport(true),
            Column::make('No', 'id')
                ->index()
                ->sortable(),
            Column::make('Petugas', 'karyawan_label', 'karyawan_id'),
            Column::make('Penjamin', 'penjamin_label', 'penjamin_id'),
            Column::make('Layanan', 'layanan_label', 'layanan_id'),
            Column::make('Nama', 'nama_pelanggan')
                ->searchable(),
            Column::make('Handphone', 'handphone_pelanggan')
                ->searchable(),
            Column::make('Shift', 'shift'),
            Column::make('Nilai skor', 'nilai_skor'),
            Column::make('Tanggal', 'survey_masuk_format_bulan', 'survey_masuk')
                ->sortable(),
            // Column::make('Jam', 'survey_masuk_format_jam', 'survey_masuk')
            //     ->sortable(),
        ];
    }

    public function filters(): array
    {
        if (Auth::user()->hasRole('employee')) {
            return [
                // Filter::datetimepicker('survey_masuk_format_bulan'),
                Filter::inputText('nama_pelanggan')
                    ->operators(['contains', 'is_not'])
                    ->placeholder('cari nama pelanggan'),
                Filter::inputText('handphone_pelanggan')
                    ->operators(['contains', 'is_not'])
                    ->placeholder('cari no hp'),
                Filter::select('penjamin_label', 'penjamin_id')
                    ->dataSource(Penjamin::all())
                    ->optionLabel('nama_penjamin')
                    ->optionValue('id'),
                Filter::select('layanan_label', 'layanan_id')
                    ->dataSource(Layanan::all())
                    ->optionLabel('nama_layanan')
                    ->optionValue('id'),
                Filter::enumSelect('shift', 'shift')
                    ->dataSource(Shift::cases())
                    ->optionLabel('shift'),
                Filter::enumSelect('nilai_skor', 'nilai_skor')
                    ->dataSource(Nilai::cases())
                    ->optionLabel('nilai_skor'),
                // Filter::datepicker('survey_masuk', 'survey_masuk'),
            ];
        } else {
            return [
                // Filter::datetimepicker('survey_masuk_format_bulan'),
                Filter::inputText('nama_pelanggan')
                    ->operators(['contains', 'is_not'])
                    ->placeholder('cari nama pelanggan'),
                Filter::inputText('handphone_pelanggan')
                    ->operators(['contains', 'is_not'])
                    ->placeholder('cari no hp'),
                Filter::select('karyawan_label', 'karyawan_id')
                    ->dataSource(KaryawanProfile::all())
                    ->optionLabel('nama_karyawanprofile')
                    ->optionValue('id'),
                Filter::select('penjamin_label', 'penjamin_id')
                    ->dataSource(Penjamin::all())
                    ->optionLabel('nama_penjamin')
                    ->optionValue('id'),
                Filter::select('layanan_label', 'layanan_id')
                    ->dataSource(Layanan::all())
                    ->optionLabel('nama_layanan')
                    ->optionValue('id'),
                Filter::enumSelect('shift', 'shift')
                    ->dataSource(Shift::cases())
                    ->optionLabel('shift'),
                Filter::enumSelect('nilai_skor', 'nilai_skor')
                    ->dataSource(Nilai::cases())
                    ->optionLabel('nilai_skor'),
                // Filter::datepicker('survey_masuk', 'survey_masuk'),
                // Filter::inputText('survey_masuk')
                //     ->operators(['contains', 'is_not'])
                //     ->placeholder('cari tanggal survey'),
            ];
        }
    }
}
