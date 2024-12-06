<?php

namespace App\Livewire\PowerGrid\Office;

use App\Models\SurveyPelanggan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

final class SurveyPelangganTabel extends PowerGridComponent
{
    use WithExport;

    protected $karyawanId;

    public function boot()
    {
        $this->karyawanId = auth()->user()->parentKaryawanProfile()->value('id');
    }

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return SurveyPelanggan::query()->where('karyawan_id', '=', $this->karyawanId)->orderBy('survey_masuk', 'DESC');
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
                   ->add('karyawan_nama_label', function ($query) {
                       return $query->parentKaryawan->nama_karyawanprofile;
                   })
                   ->add('penjamin_id')
                   ->add('penjamin_nama_label', function ($query) {
                       return $query->parentPenjamin->nama_penjamin;
                   })
                   ->add('layanan_id')
                   ->add('layanan_nama_label', function ($query) {
                       return $query->parentLayanan->nama_layanan;
                   })
                   ->add('nama_pelanggan')
                   ->add('handphone_pelanggan')
                   ->add('shift')
                   ->add('nilai_skor')
                   ->add('survey_masuk')
                   ->add('survey_masuk_formatted_jam', fn(SurveyPelanggan $model)  => Carbon::parse($model->survey_masuk)->format('H:i:s'))
                   ->add('survey_masuk_formatted_date', fn(SurveyPelanggan $model) => Carbon::parse($model->survey_masuk)->format('Y-m-d'));
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'id')
                ->index(),
            Column::make('Id', 'id')
                ->hidden(isHidden: true, isForceHidden: false),
            Column::make('Pegawai', 'karyawan_nama_label', 'karyawan_id'),
            Column::make('Penjamin', 'penjamin_nama_label', 'penjamin_id')
                ->sortable(),
            Column::make('Layanan', 'layanan_nama_label', 'layanan_id')
                ->sortable(),
            Column::make('Nama pasien', 'nama_pelanggan')
                ->searchable(),
            Column::make('Handphone pasien', 'handphone_pelanggan')
                ->searchable(),
            Column::make('Nilai', 'nilai_skor')
                ->sortable(),
            Column::make(
                'Jam',
                'survey_masuk_formatted_jam',
            )->sortable(),
            Column::make('Tanggal', 'survey_masuk_formatted_date', 'survey_masuk')
                ->sortable(),
            Column::make('Shift', 'shift')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('survey_masuk_formatted_date', 'survey_masuk')
                ->params([
                    'format'   => 'Y-m-d',
                    'timezone' => 'Asia/Jakarta'
                ])
        ];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions(SurveyPelanggan $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    /*
     * public function actionRules($row): array
     * {
     *    return [
     *         // Hide button edit for ID 1
     *         Rule::button('edit')
     *             ->when(fn($row) => $row->id === 1)
     *             ->hide(),
     *     ];
     * }
     */
}
