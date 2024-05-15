<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaPermisi;

    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
        $this->id = $permission->id;
        $this->namaPermisi = $permission->name;
    }

    public function store()
    {
        $this->validate();
        try {
            $permission = new Permission;
            $permission->name = $this->namaPermisi;
            $permission->save();
            $this->reset();
            return $permission;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $permission = Permission::find($this->id);
            $permission->name = $this->namaPermisi;
            $permission->save();
            $this->reset();
            return $permission;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
