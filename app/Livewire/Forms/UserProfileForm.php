<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserProfileForm extends Form
{
    #[Locked]
    public $id;
    
    #[Locked]
    public $userId;

    #[Locked]
    public $nppKaryawan;

    #[Locked]
    public $unitKaryawan;

    #[Locked]
    public $layananKaryawan;

    #[Validate('required')]
    public $namaKaryawan;

    #[Validate('required')]
    public $userEmail;

    public function setProfile($id)
    {
        $karyawanProfile = KaryawanProfile::with(['parentKaryawan'])->find($id);
        $this->profileKaryawan = $karyawanProfile;
        $this->id = $karyawanProfile->id;
        $this->nppKaryawan = $karyawanProfile->parentKaryawan->npp_karyawan;
        $this->unitKaryawan = $karyawanProfile->parentUnit->nama_unit;
        $this->layananKaryawan = $karyawanProfile->parentLayanan->nama_layanan;
        $this->namaKaryawan = $karyawanProfile->nama_karyawanprofile;
    }

    public function setUser($id)
    {
        $user = User::find($id);
        $this->user = $user;
        $this->userId = $user->id;
        $this->userEmail = $user->email;
    }

    public function updateUser()
    {
        $this->validateOnly('userEmail');
        try {
            $user = User::find($this->userId);
            $user->email = $this->userEmail;
            $user->save();

            if ($user) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        $this->validateOnly('namaKaryawan');
        try {
            $statement = DB::transaction(function () {
                $karyawanProfile = KaryawanProfile::find($this->id);
                $karyawanProfile->nama_karyawanprofile = $this->namaKaryawan;
                $karyawanProfile->save();

                $user = User::find(session()->get('userId'));
                $user->name = $this->namaKaryawan;
                $user->save();
            });

            if ($statement == null) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
