<?php

namespace App\Livewire\PowerGrid;

use App\Livewire\Attributes\Locked;
use App\Models\LayananRespon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
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

final class LayananResponTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        $this->showRadioButton();

        return [
            Exportable::make(fileName: 'layanan_respon')
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
        return LayananRespon::query()->orderBy('layanan_id');
    }

    public function relationSearch(): array
    {
        return [
            'parentLayanan' => 'nama_layanan',
            'parentRespon' => 'nama_respon',
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('layanan_id', fn(LayananRespon $layananRespon) => $layananRespon->parentLayanan->nama_layanan)
            ->add('respon_id', fn(LayananRespon $layananRespon) => $layananRespon->parentRespon->nama_respon)
            ->add('skor_respon', fn(LayananRespon $layananRespon) => $layananRespon->parentRespon->skor_respon)
            ->add('urutan_respon', fn(LayananRespon $layananRespon) => $layananRespon->parentRespon->urutan_respon);
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
            Column::make('Nama layanan', 'layanan_id')
                ->sortable()
                ->searchable(),
            Column::make('Nama respon', 'respon_id')
                ->sortable()
                ->searchable(),
            Column::make('Skor respon', 'skor_respon')
                ->sortable(),
            Column::make('Urutan respon', 'urutan_respon'),
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
        $layananRespon = LayananRespon::find($rowId);
        $this->id = $layananRespon->id;
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
            $layananRespon = LayananRespon::find($this->id);
            $layananRespon->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data layanan respon berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(LayananRespon $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-layanan-respon-edit', [$row->id]),
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
            Rule::rows()
                ->setAttribute('class', ''),
        ];
    }
}
