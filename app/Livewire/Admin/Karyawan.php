<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Karyawan as KaryawanModel;

class Karyawan extends Component
{
    public function render()
    {
        $karyawans = KaryawanModel::latest()->get();
        return view('livewire.admin.karyawan')->with([
            'karyawans' => $karyawans,
        ]);
    }
}
