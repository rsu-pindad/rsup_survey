<?php

namespace App\Livewire\Forms;

use App\Models\Karyawan;
use App\Models\User;
use App\Models\KaryawanProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attribures\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class KaryawanProfileEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $idUser;

    #[Validate('required')]
    public $idKaryawan;

    #[Validate('required')]
    public $idUnit;

    #[Validate('required')]
    public $idLayanan;

    #[Validate('required')]
    public $namaKaryawan;

    public $idKaryawanOld;

    public function setKaryawanProfile(KaryawanProfile $karyawanProfile)
    {
        $this->karyawanProfile = $karyawanProfile;
        $this->id = $karyawanProfile->id;
        $this->idUser = $karyawanProfile->user_id;
        $this->idKaryawan = $karyawanProfile->karyawan_id;
        $this->idKaryawanOld = $karyawanProfile->karyawan_id;
        $this->idUnit = $karyawanProfile->unit_id;
        $this->idLayanan = $karyawanProfile->layanan_id;
        $this->namaKaryawan = $karyawanProfile->nama_karyawanprofile;
        // $this->emailKaryawan = User::find($this->idUser)->email;
    }

    public function store()
    {
        $this->validate();
        try {
            $nows = Carbon::now()->setTimezone('Asia/Jakarta');
            $statement = DB::transaction(function () {
                $karyawan = Karyawan::find($this->idKaryawan);
                $karyawan->taken = 0;
                $karyawan->active = 1;
                $karyawan->updated_at = $nows;
                $karyawan->save();
                $karyawanProfile = new KaryawanProfile;
                $karyawanProfile->user_id = $this->idUser;
                $karyawanProfile->karyawan_id = $this->idKaryawan;
                $karyawanProfile->unit_id = $this->idUnit;
                $karyawanProfile->layanan_id = $this->idLayanan;
                $karyawanProfile->nama_karyawanprofile = $this->namaKaryawan;
                $karyawanProfile->save();
            }, 5);
            // dd($karyawanProfile);
            if ($statement) {
                $this->reset();
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
        // $this->validateOnly('idKaryawan');
        try {
            $nows = Carbon::now()->setTimezone('Asia/Jakarta');
            $statement = DB::transaction(function () {
                if ($this->idKaryawanOld != $this->idKaryawan) {
                    $karyawanOld = Karyawan::find($this->idKaryawanOld);
                    $karyawanOld->taken = 0;
                    $karyawanOld->active = 1;
                    $karyawanOld->updated_at = $nows;
                    $karyawanOld->save();

                    $karyawan = Karyawan::find($this->idKaryawan);
                    $karyawan->taken = 1;
                    $karyawan->active = 1;
                    $karyawan->updated_at = $nows;
                    $karyawan->save();
                }

                $karyawanProfile = KaryawanProfile::find($this->id);
                if ($this->idKaryawanOld != $this->idKaryawan) {
                    $karyawanProfile->karyawan_id = $this->idKaryawan;
                }
                $karyawanProfile->unit_id = $this->idUnit;
                $karyawanProfile->layanan_id = $this->idLayanan;
                $karyawanProfile->nama_karyawanprofile = $this->namaKaryawan;
                $karyawanProfile->save();
                return;
            }, 5);
            if ($statement == null) {
                $this->reset();
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
