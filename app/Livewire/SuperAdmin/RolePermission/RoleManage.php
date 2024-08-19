<?php

namespace App\Livewire\SuperAdmin\RolePermission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Livewire\Attributes\On;
use App\Livewire\Attributes\Locked;

class RoleManage extends Component
{

    #[Locked]
    public $idRole;

    #[Locked]
    public $namaRole;

    #[Locked]
    public $roleHasPermission;

    public $permissionSelect = [];

    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->idRole = $this->role->id;
        $this->namaRole = $this->role->name;
        $this->roleHasPermission = $this->role->permissions->pluck('name');
        $this->permissionSelect = $this->roleHasPermission;
    }

    public function update()
    {
        $this->dispatch('contentChanged');
    }

    #[On('contentChanged')]
    public function updated()
    {
        // dd($this->permissionSelect);
        // dd($this->idRole);
        $role = Role::find($this->idRole);
        $role->syncPermissions([$this->permissionSelect]);
    }

    public function render()
    {
        return view('livewire.super-admin.role-permission.role-manage')->with([
            'permission' => Permission::get(),
        ]);
    }
}
