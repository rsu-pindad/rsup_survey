<?php

namespace App\Livewire\PowerGrid;

use App\Livewire\Attributes\Locked;
use App\Models\Respon;
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

final class ResponTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $id;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'urutan_respon';

    public string $sortDirection = 'desc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        $this->showCheckBox();

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
        return Respon::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_respon')
            ->add('tag_warna_respon', function ($respon) {
                return '<span class="badge rounded-pill" style="background-color:' . $respon->tag_warna_respon . '">' . $respon->tag_warna_respon . '</span>';
            })
            ->add('has_question', function ($respon) {
                return $respon->has_question == true ? '<span class="badge rounded-pill text-bg-success">Iya</span>' : '<span class="badge rounded-pill text-bg-danger">Tidak</span>';
            })
            ->add('icon_respon', function ($respon) {
                return '<i class="' . $respon->icon_respon . ' fa-xl" style="color: ' . $respon->tag_warna_respon . ';"></i>';
            })
            ->add('skor_respon')
            ->add('urutan_respon');
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
            Column::make('Nama respon', 'nama_respon')
                ->sortable()
                ->searchable(),
            Column::make('Icon respon', 'icon_respon')
                ->visibleInExport(false),
            Column::make('Tag warna respon', 'tag_warna_respon')
                ->visibleInExport(false),
            Column::make('Pertanyaan', 'has_question')
                ->visibleInExport(false),
            Column::make('Skor respon', 'skor_respon')
                ->visibleInExport(false),
            Column::make('Urutan respon', 'urutan_respon')
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
        $respon = Respon::find($rowId);
        $this->id = $respon->id;
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
            $respon = Respon::find($this->id);
            $respon->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data respon berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(Respon $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-respon-edit', [$row->id]),
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
