<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SurveyForm extends Form
{
    #[Validate('required', message: 'mohon isi nama anda')]
    #[Validate('min:3', message: 'minimal 3 huruf')]
    #[Validate('max:50', message: 'maksimal 50 huruf')]
    public $name;

    #[Validate('required', message: 'mohon isi nomor telepon anda')]
    #[Validate('numeric', message: 'hanya angka')]
    #[validate('min:10', message: 'minimal 10 angka')]
    public $phone;

    #[Validate('required', message: 'mohon pilih penjamin')]
    public $penjamin;

    public function store()
    {
        $profileKaryawan = KaryawanProfile::where('user_id', session()->get('userId'))->first();
        try {
            session()->put('karyawan_id', $profileKaryawan->id);
            session()->put('penjamin_layanan_id', $this->penjamin);
            session()->put('nama_pelanggan', $this->name);
            session()->put('handphone_pelanggan', $this->phone);
            session()->put('shift', 1);
            session()->put('nilai_skor', 0);
            return true;
        } catch (\Throwable $th) {
            // Log::info($th);
            // return false;
            return $th->getMessage();
        }
    }
}
