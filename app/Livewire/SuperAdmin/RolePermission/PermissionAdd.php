<?php

namespace App\Livewire\SuperAdmin\RolePermission;

use App\Livewire\Forms\PermissionForm as Form;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionAdd extends Component
{
    

    public Form $form;

    public function mount(Permission $permission)
    {
        $this->form->setPermission($permission);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data permisi berhasil ditambahkan',
            ]);
            $this->dispatch('table-updated');
        } else {
            $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $store,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.super-admin.role-permission.permission-add');
    }
}
