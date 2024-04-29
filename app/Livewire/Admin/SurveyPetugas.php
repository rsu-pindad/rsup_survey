<?php

namespace App\Livewire\Admin;

use App\Models\KaryawanProfile;
use App\Models\SurveyPelanggan;
use Livewire\Component;

class SurveyPetugas extends Component
{
    public $survey;
    
    public function mount($id)
    {
        $karyawanProfile = KaryawanProfile::where('user_id', $id)->first();
        // dd($karyawanProfile->toArray());
        $this->survey = SurveyPelanggan::where('karyawan_id', $karyawanProfile->id)->get();
        // dd($this->survey->toArray());
    }

    public function render()
    {
        return view('livewire.admin.survey-petugas')->with([
            'surveys' => $this->survey,
        ]);
    }
}
