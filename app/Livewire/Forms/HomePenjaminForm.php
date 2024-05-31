<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HomePenjaminForm extends Form
{
    #[Validate('required', message: 'mohon pilih penjamin')]
    public $penjamin;

    public function store()
    {
        $profileKaryawan = KaryawanProfile::where('user_id', session()->get('userId'))->first();
        try {
            session()->put('karyawan_id', $profileKaryawan->id);
            session()->put('penjamin_layanan_id', $this->penjamin);
            session()->put('shift', 1);
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
