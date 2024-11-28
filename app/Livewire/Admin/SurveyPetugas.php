<?php

namespace App\Livewire\Admin;

use App\Models\SurveyPelanggan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SurveyPetugas extends Component
{
    public function render()
    {
        // dd(Auth::user()->parentKaryawanProfile()->value('id'));
        // dd(Auth::user()->parentKaryawanProfile->karyawan_id);
        // $data = SurveyPelanggan::with(['parentPenjamin', 'parentLayanan'])->where('karyawan_id', Auth::user()->parentKaryawanProfile()->value('id'))->get();

        // return view('livewire.admin.survey-petugas')->with(['data' => $data]);
        return view('livewire.admin.survey-petugas');
    }
}
