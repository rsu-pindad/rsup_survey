<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

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
