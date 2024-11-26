<?php

namespace App\Livewire\SuperAdmin\RolePermission;

use App\Livewire\Forms\RoleForm as Form;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->role = Role::findOrFail($id);
        $this->form->setRole($this->role);
    }

    public function render()
    {
        return view('livewire.super-admin.role-permission.role-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data role berhasil diperbarui',
            ], route('root-super-admin-role'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }
}
