<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaRole;

    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->id = $role->id;
        $this->namaRole = $role->name;
    }

    public function store()
    {
        $this->validate();
        try {
            $role = new Role;
            $role->name = $this->namaRole;
            $role->save();
            $this->reset();
            return $role;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $role = Role::find($this->id);
            $role->name = $this->namaRole;
            $role->save();
            $this->reset();
            return $role;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
