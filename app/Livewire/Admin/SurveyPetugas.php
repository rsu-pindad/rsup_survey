<?php

namespace App\Livewire\Admin;

use App\Models\SurveyPelanggan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SurveyPetugas extends Component
{
    public function render()
    {
        // dd(Auth::user()->parentKaryawanProfile->karyawan_id);
        // $data = SurveyPelanggan::with(['parentPenjamin', 'parentLayanan'])->where('karyawan_id', session()->get('karyawan_id'))->get();
        return view('livewire.admin.survey-petugas');
    }
}
