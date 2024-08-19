<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class RootsAdmin extends Component
{
    public function render()
    {
        $appSettings = Cache::remember('appSetting', now()->addMinutes(360), function () {
            return AppSetting::get()->last();
        });

        return view('livewire.admin.roots-admin')->with([
            'appSetting' => $appSettings,
        ]);
    }
}
