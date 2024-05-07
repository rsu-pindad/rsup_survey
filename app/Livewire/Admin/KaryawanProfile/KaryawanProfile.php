<?php

namespace App\Livewire\Admin\KaryawanProfile;

use Livewire\Component;
use App\Models\KaryawanProfile as KPM;

class KaryawanProfile extends Component
{
    public function render()
    {
        $karyawanProfiles = KPM::latest()->get();
        return view('livewire.admin.karyawan-profile.karyawan-profile')->with([
            'karyawanProfiles' => $karyawanProfiles,
        ]);
    }
}
