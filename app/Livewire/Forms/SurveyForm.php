<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SurveyForm extends Form
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $phone;

    #[Validate('required')]
    public $penjamin;

    public function store()
    {
        $this->validate();
        $profileKaryawan = KaryawanProfile::where('user_id', Auth::user()->id)->first();
        try {
            // $store = new SurveyPelanggan;
            // $store->karyawan_id = $profileKaryawan->id;
            // $store->penjamin_layanan_id = $this->penjamin;
            // $store->nama_pelanggan = $this->name;
            // $store->handphone_pelanggan = $this->phone;
            // $store->shift = 1;
            // $store->nilai_skor = 0;
            // $store->save();
            session()->put('karyawan_id', $profileKaryawan->id);
            session()->put('penjamin_layanan_id', $this->penjamin);
            session()->put('nama_pelanggan', $this->name);
            session()->put('handphone_pelanggan', $this->phone);
            session()->put('shift', 1);
            session()->put('nilai_skor', 0);
            return true;
        } catch (\Throwable $th) {
            // Log::info($th);
            return false;
        }
    }
}
