<?php

namespace App\Livewire\PowerGrid;

use App\Models\Karyawan;
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

final class KaryawanTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancalled'
    ];

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
        return Karyawan::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('npp_karyawan')
            ->add('taken')
            ->add('active');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Npp karyawan', 'npp_karyawan')
                ->sortable()
                ->searchable(),
            Column::make('Taken', 'taken')
                ->sortable(),
            Column::make('Active', 'active')
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $karyawan = Karyawan::find($rowId);
        $this->id = $karyawan->id;
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
            $karyawan = Karyawan::find($this->id);
            $karyawan->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(Karyawan $row): array
    {
        return [
            Button::add('edit')
                ->slot('edit')
                ->class('btn btn-info')
                ->route('root-karyawan-edit', [$row->id]),
            Button::add('delete')
                ->slot('hapus')
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
            Rule::rows()
                ->setAttribute('class', ''),
        ];
    }
}
