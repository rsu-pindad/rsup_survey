<?php

namespace App\Livewire\SuperAdmin\User;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Livewire\Attributes\On;
use App\Livewire\Attributes\Locked;
use App\Models\User;

class UserManage extends Component
{
    #[Locked]
    public $idUser;

    #[Locked]
    public $namaUser;

    #[Locked]
    public $userHasRole;

    public $roleSelect = [];

    public function mount($id)
    {
        $this->role = Role::all();
        $this->user = User::find($id);
        $this->idUser = $this->user->id;
        $this->namaUser = $this->user->name;
        $this->userHasRole = $this->user->getRoleNames();
        $this->roleSelect = $this->userHasRole;
    }

    public function update()
    {
        $this->dispatch('contentChanged');
    }

    #[On('contentChanged')]
    public function updated()
    {
        $user = User::find($this->idUser);
        $user->syncRoles([$this->roleSelect]);
    }

    public function render()
    {
        return view('livewire.super-admin.user.user-manage')->with([
            'roles' => Role::whereNot('name','super-admin')->get(),
        ]);
    }
}
