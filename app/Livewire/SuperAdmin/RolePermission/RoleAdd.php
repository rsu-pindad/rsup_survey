<?php

namespace App\Livewire\SuperAdmin\RolePermission;

use Livewire\Component;
use App\Livewire\Forms\RoleForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class RoleAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(Role $role)
    {
        $this->form->setRole($role);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data role berhasil ditambahkan',
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
        return view('livewire.super-admin.role-permission.role-add');
    }
}
