<?php

namespace App\Livewire\Forms;

use App\Models\Karyawan;
use App\Models\KaryawanProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class RegisterForm extends Form
{
    public function store($idNpp, $namaKaryawan, $unitKaryawan, $layananKaryawan, $email, $password)
    {
        // dd($idNpp, $namaKaryawan);
        try {
            $nows = Carbon::now()->setTimezone('Asia/Jakarta');
            $findKaryawan = Karyawan::where('npp_karyawan', $idNpp)->first();
            // dd($findKaryawan->id);
            $idNppNew = $findKaryawan->id;
            $statement = DB::transaction(function () use ($idNppNew, $namaKaryawan, $unitKaryawan, $layananKaryawan, $email, $password) {
                $user = new User;
                $user->name = $namaKaryawan;
                $user->email = $email;
                $user->password = bcrypt($password);
                $user->save();

                $karyawan = Karyawan::find($idNppNew);
                $karyawan->taken = 1;
                $karyawan->active = 1;
                $karyawan->save();
                // $karyawan->updated_at = $nows;

                $karyawanProfile = new KaryawanProfile;
                $karyawanProfile->user_id = $user->id;
                $karyawanProfile->karyawan_id = $karyawan->id;
                $karyawanProfile->unit_id = $unitKaryawan;
                $karyawanProfile->layanan_id = $layananKaryawan;
                $karyawanProfile->nama_karyawanprofile = $namaKaryawan;
                $karyawanProfile->save();
            }, 5);
            if ($statement == false) {
                $this->reset();
                return true;
            } else {
                $this->reset('password');
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
