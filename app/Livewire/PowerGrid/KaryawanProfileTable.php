<?php

namespace App\Livewire\PowerGrid;

use App\Livewire\Attributes\Locked;
use App\Models\KaryawanProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class KaryawanProfileTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'unit_id';

    public string $sortDirection = 'asc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        $this->showRadioButton();

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

    #[\Livewire\Attributes\On('table-updated')]
    public function datasource(): Builder
    {
        return KaryawanProfile::query();
    }

    public function relationSearch(): array
    {
        return [
            'parentKaryawan' => 'npp_karyawan'
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('user_id', fn(KaryawanProfile $karyawanProfile) => $karyawanProfile->parentUser->email)
            ->add('karyawan_id', fn(KaryawanProfile $karyawanProfile) => $karyawanProfile->parentKaryawan->npp_karyawan)
            ->add('unit_id', fn(KaryawanProfile $karyawanProfile) => $karyawanProfile->parentUnit->nama_unit)
            ->add('layanan_id', fn(KaryawanProfile $karyawanProfile) => $karyawanProfile->parentLayanan->nama_layanan)
            ->add('nama_karyawanprofile')
            ->add('updated_at')
            ->add('updated_at_formatted', function ($karyawanProfile) {
                return Carbon::parse($karyawanProfile->updated_at)->format('H:i:s D');  // 20/01/2024 10:05
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->visibleInExport(false)
                ->hidden(isHidden: true, isForceHidden: true),
            Column::make('No', 'id')
                ->title('No')
                ->index(),
            Column::make('Unit', 'unit_id'),
            Column::make('Npp', 'karyawan_id')
                ->sortable()
                ->searchable(),
            Column::make('Nama', 'nama_karyawanprofile')
                ->searchable(),
            Column::make('Layanan', 'layanan_id'),
            Column::make('Email', 'user_id')
                ->visibleInExport(false),
            Column::make('Updated at', 'updated_at_formatted')
                ->sortable()
                ->visibleInExport(false),
            Column::action('Action')
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $karyawanProfile = KaryawanProfile::find($rowId);
        $this->id = $karyawanProfile->id;
        $this->confirm('Anda yakin akan menghapus data ini ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        try {
            $karyawanProfile = KaryawanProfile::find($this->id);
            $karyawanProfile->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan-profile berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(KaryawanProfile $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-karyawan-profile-edit', [$row->id]),
            Button::add('delete')
                ->slot('<i class="fa-solid fa-trash-can"></i>')
                ->id()
                ->class('btn btn-warning')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    public function actionRules($row): array
    {
        return [
            Rule::radio()
                ->when(fn($row) => $row->id == $this->selectedRow)
                ->setAttribute('class', ''),
            Rule::radio()
                ->when(fn($row) => $row->parentKaryawan->active == 1)
                ->hide(),
            Rule::rows()
                ->setAttribute('class', ''),
            Rule::button('edit')
            ->when(fn($row) => $row->parentKaryawan->active == 0)
            ->hide(),
            Rule::button('delete')
            ->when(fn($row) => $row->parentKaryawan->active == 1)
            ->hide()
        ];
    }
}
