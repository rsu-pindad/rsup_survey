<?php

namespace App\Livewire\Admin;

use App\Models\SurveyPelanggan;
use Livewire\Component;

class SurveyPetugas extends Component
{
    public function render()
    {
        return view('livewire.admin.survey-petugas')->with([
            'surveys' => SurveyPelanggan::where('karyawan_id', session()->get('karyawan_id'))->get(),
        ]);
    }
}
