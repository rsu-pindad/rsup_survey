<?php

namespace App\Livewire\PowerGrid\SuperAdmin;

use App\Livewire\Attributes\Locked;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use Spatie\Permission\Models\Role;

final class RoleTable extends PowerGridComponent
{
    use WithExport, LivewireAlert;

    #[Locked]
    public $idRole;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        // $this->showRadioButton();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    #[\Livewire\Attributes\On('table-updated')]
    public function datasource(): Builder
    {
        return Role::query()->whereNot('name', 'super-admin');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('permission', fn($roles) => e($roles->permissions()->pluck('name')))
            ->add('permission_format', function ($roles) {
                // dd($roles->permissions);
                if (count($roles->permissions) < 1) {
                    return 'blm ada permisi';
                }
                $list = '';
                foreach ($roles->permissions as $permission => $value) {
                    $list .= '<p>' . $value->name . '</p>';
                }
                return $list;
            })
            ->add('created_at_formatted', function ($role) {
                return Carbon::parse($role->created_at)->format('d-M-Y');  // 20/01/2024 10:05
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
            Column::make('Nama Role', 'name')
                ->sortable()
                ->searchable(),
            Column::make(
                title: 'Permisi',
                field: 'permission_format',
                dataField: 'permission'
            )
                ->searchable(),
            // ->sortable(),
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
        $role = Role::find($rowId);
        $this->idRole = $role->id;
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
            $role = Role::find($this->id);
            $role->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data role berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function actions(Role $row): array
    {
        return [
            Button::add('manage')
                ->slot('<i class="fa-solid fa-gear"></i>')
                ->class('btn btn-secondary')
                ->route('root-super-admin-role-manage', [$row->id]),
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pen-to-square"></i>')
                ->class('btn btn-info')
                ->route('root-super-admin-role-edit', [$row->id]),
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
