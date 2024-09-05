<?php

namespace App\Livewire\PowerGrid;

use App\Models\Unit;
use Livewire\Attributes\Locked;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UnitTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'nama_unit';

    public string $sortDirection = 'asc';

    public bool $withSortStringNumber = true;

    // public $tableName = [];

    public function placeholder()
    {
        return <<<'HTML'
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            HTML;
    }

    public function setUp(): array
    {
        // $this->showRadioButton();
        $this->showCheckBox();
        $this->persist(
            tableItems: ['columns', 'sort'],
            prefix: Auth()->id()
        );

        return [
            Exportable::make(fileName: 'Unit Survey')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    // public function header(): array
    // {
    //     return [
    //         Button::add('bulk-delete')
    //             ->slot(__('Bulk delete (<span x-text="window.pgBulkActions.count(\'' . $this->tableName . '\')"></span>)'))
    //             ->class('btn btn-secondary-outline')
    //             ->dispatch('bulkDelete' . $this->tableName, []),
    //     ];
    // }

    #[\Livewire\Attributes\On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        $this->js("alert(window.pgBulkActions.get('" . $this->tableName . "'))");
    }

    #[\Livewire\Attributes\On('table-updated')]
    public function datasource(): Builder
    {
        return Unit::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_unit')
            ->add('multi_penilaian_formatted', function ($unit) {
                return $unit->multi_penilaian === true ? '<span class="badge rounded-pill text-bg-success">Iya</span>' : '<span class="badge rounded-pill text-bg-danger">Tidak</span>';
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('Id')
                ->field('id')
                ->visibleInExport(false)
                ->hidden(isHidden: true, isForceHidden: true),
            Column::add()
                ->title('No')
                ->field('id')
                ->index(),
            Column::add()
                ->title('Nama Unit')
                ->field('nama_unit')
                ->sortable()
                ->searchable(),
            Column::add()
                ->title('Multi Penilaian')
                ->field(field: 'multi_penilaian_formatted', dataField: 'multi_penilaian')
                ->sortable(),
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
        $unit = Unit::find($rowId);
        $this->id = $unit->id;
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
            $unit = Unit::find($this->id);
            $unit->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center-start',
                'toast' => true,
                'text' => 'data unit berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'bottom',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(Unit $row): array
    {
        return [
            Button::add('manage')
                ->slot('<i class="fa-solid fa-gear"></i>')
                ->class('btn btn-secondary')
                ->route('root-unit-profil', [$row->id]),
            Button::add('layanan')
                ->slot('<i class="fa-solid fa-tags"></i>')
                ->class('btn btn-outline-secondary')
                ->route('root-multi-layanan', [$row->id]),
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-unit-edit', [$row->id]),
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
                ->when(fn($row) => $row->id === $this->selectedRow)
                ->setAttribute('class', ''),
            Rule::rows()
                ->setAttribute('class', ''),
            Rule::button('layanan')
                ->when(fn($row) => $row->multi_penilaian === false)
                ->hide(),
        ];
    }
}
