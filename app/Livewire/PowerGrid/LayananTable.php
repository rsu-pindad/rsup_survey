<?php

namespace App\Livewire\PowerGrid;

use App\Livewire\Attributes\Locked;
use App\Models\Layanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
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

final class LayananTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'nama_layanan';

    public string $sortDirection = 'asc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        // $this->showCheckBox();
        $this->showRadioButton();

        return [
            Exportable::make(fileName: 'Layanan Tabel')
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
        return Layanan::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_layanan');
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
            Column::make('Nama layanan', 'nama_layanan')
                ->sortable()
                ->searchable(),
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
        $layanan = Layanan::find($rowId);
        $this->id = $layanan->id;
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
            $layanan = Layanan::find($this->id);
            $layanan->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data layanan berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(Layanan $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-layanan-edit', [$row->id]),
            Button::add('delete')
                ->slot('<i class="fa-solid fa-trash-can"></i>')
                ->id()
                ->class('btn btn-warning')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    public function actionRules($row): array
    {
        // return [
        //     // Hide button edit for ID 1
        //     Rule::button('edit')
        //         ->when(fn($row) => $row->id === 1)
        //         ->hide(),
        // ];
        return [
            Rule::radio()
                ->when(fn($row) => $row->id == $this->selectedRow)
                ->setAttribute('class', ''),
            // Rule::rows()
            //     ->setAttribute('wire:click', "\$set('selectedRow', " . $row->id . ')'),
            Rule::rows()
                ->setAttribute('class', ''),
        ];
    }
}
