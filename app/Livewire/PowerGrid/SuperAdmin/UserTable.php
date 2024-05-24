<?php

namespace App\Livewire\PowerGrid\SuperAdmin;

use App\Livewire\Attributes\Locked;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class UserTable extends PowerGridComponent
{
    use WithExport;

    #[Locked]
    public $id;

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

    public bool $withSortStringNumber = true;

    public function setUp(): array
    {
        $this->showRadioButton();

        return [
            Exportable::make(fileName: 'User')
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
        return User::query()->withoutRole('super-admin');
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
            ->add('email')
            ->add('role', fn($user) => e($user->getRoleNames()))
            ->add('role_format', function($user){
                if(count($user->roles) < 1){
                    return 'blm ada role';
                }
                $ulist = '';
                foreach ($user->roles as $role => $value) {
                    $ulist .= '<p>'.$value->name.'</p>';
                }
                return $ulist;
            })
            ->add('last_login')
            ->add('last_login_formatted', function ($user) {
                return Carbon::parse($user->last_login)->format('H:i D');  // 20/01/2024 10:05
            })
            ->add('created_at')
            ->add('created_at_formatted', function ($user) {
                return Carbon::parse($user->created_at)->format('d-M-Y');  // 20/01/2024 10:05
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
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Email', 'email')
                ->searchable()
                ->visibleInExport(true)
                ->hidden(isHidden: true, isForceHidden: true),
            Column::make('Role', 'role_format')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('Last login', 'last_login_formatted')
                ->sortable()
                ->visibleInExport(false),
            Column::make('Created at', 'created_at_formatted')
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

    public function actions(User $row): array
    {
        return [
            Button::add('manage')
                ->slot('<i class="fa-solid fa-gear"></i>')
                ->class('btn btn-secondary')
                ->route('root-super-admin-user-manage', [$row->id]),
            // Button::add('edit')
            //     ->slot('edit')
            //     ->class('btn btn-info')
            //     ->route('root-super-admin-user-edit', [$row->id]),
        ];
    }

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
