<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AppSetting;

class RootsAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.roots-admin')->with([
            'appSetting' => AppSetting::get()->last(),
        ]);
    }
}
