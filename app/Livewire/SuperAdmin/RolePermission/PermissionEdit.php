<?php

namespace App\Livewire\SuperAdmin\RolePermission;

use App\Livewire\Forms\PermissionForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->permission = Permission::findOrFail($id);
        $this->form->setPermission($this->permission);
    }

    public function render()
    {
        return view('livewire.super-admin.role-permission.permission-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data permisi berhasil diperbarui',
            ], route('root-super-admin-permission'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }
}
