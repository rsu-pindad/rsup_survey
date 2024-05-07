<?php

namespace App\Livewire\PowerGrid;

use App\Livewire\Attributes\Locked;
use App\Models\PenjaminLayanan;
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

final class PenjaminLayananTable extends PowerGridComponent
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
        return PenjaminLayanan::query()->orderBy('penjamin_id');
    }

    public function relationSearch(): array
    {
        return [
            'parentPenjamin' => 'nama_penjamin',
            'parentLayanan' => 'nama_layanan',
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('penjamin_id', fn(PenjaminLayanan $penjaminLayanan) => $penjaminLayanan->parentPenjamin->nama_penjamin)
            ->add('layanan_id', fn(PenjaminLayanan $penjaminLayanan) => $penjaminLayanan->parentLayanan->nama_layanan);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nama penjamin', 'penjamin_id')->sortable()
            ->searchable(),
            Column::make('Nama layanan', 'layanan_id'),
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
        $penjaminLayanan = PenjaminLayanan::find($rowId);
        $this->id = $penjaminLayanan->id;
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
            $penjaminLayanan = PenjaminLayanan::find($this->id);
            $penjaminLayanan->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data penjamin layanan berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(PenjaminLayanan $row): array
    {
        return [
            Button::add('edit')
                ->slot('edit')
                ->class('btn btn-info')
                ->route('root-penjamin-layanan-edit', [$row->id]),
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
