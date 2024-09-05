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
        try {
            $profileKaryawan = KaryawanProfile::where('user_id', session()->get('userId'))->first();
            session()->put('karyawan_id', $profileKaryawan->id);
            session()->put('penjamin_layanan_id', $this->penjamin);
            session()->put('shift', 1);
            // return true;
            // dd(session()->get('userLayananMulti'));
            if (session()->get('multiPenilaian') === true && session()->get('userLayananMulti') === true) {
                // Multiple
                return redirect()->route('isi-survey-pelayanan-multi');
            } else {
                // Non Multiple
                return redirect()->route('isi-survey-pelayanan');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
