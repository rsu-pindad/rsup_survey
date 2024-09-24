<?php

namespace App\Livewire\Forms;

use App\Models\Karyawan;
use App\Models\KaryawanProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RegisterForm extends Form
{
    #[Validate('required')]
    public $getNpp;

    #[Validate('required')]
    public $idUnit;

    #[Validate('required')]
    public $idLayanan;

    #[Validate('required')]
    public $namaKaryawan;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:5')]
    public $password;

    public function store()
    {
        $this->validate();
        try {
            $findKaryawan = Karyawan::where('npp_karyawan', $this->getNpp)->first();
            Role::updateOrCreate(
                ['name' => 'employee'],
                ['name' => 'employee']
            );
            $statement = DB::transaction(function () use ($findKaryawan) {
                $user           = new User;
                $user->name     = $this->namaKaryawan;
                $user->email    = $this->email;
                $user->password = bcrypt($this->password);
                $user->assignRole('employee');
                $user->save();

                $karyawan         = Karyawan::find($findKaryawan->id);
                $karyawan->taken  = 1;
                $karyawan->active = 1;
                $karyawan->save();

                $karyawanProfile                       = new KaryawanProfile;
                $karyawanProfile->user_id              = $user->id;
                $karyawanProfile->karyawan_id          = $karyawan->id;
                $karyawanProfile->unit_id              = $this->idUnit;
                $karyawanProfile->layanan_id           = $this->idLayanan;
                $karyawanProfile->nama_karyawanprofile = $this->namaKaryawan;
                $karyawanProfile->save();
            }, 3);
            $this->reset('password');

            return $result = [
                'status'  => true,
                'message' => 'daftar berhasil, silahkan login',
            ];
        } catch (\Throwable $th) {
            $this->reset('password');

            return $result = [
                'status'  => false,
                'message' => $th->getMessage(),
            ];
        }
    }
}
