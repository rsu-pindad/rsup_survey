<?php

namespace App\Livewire\Forms;

use App\Models\Karyawan;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class KaryawanEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $nppKaryawan;

    public $takenKaryawan;
    public $activeKaryawan;
    public $karyawan;

    public function setKaryawan(Karyawan $karyawan)
    {
        $this->karyawan       = $karyawan;
        $this->id             = $karyawan->id;
        $this->nppKaryawan    = $karyawan->npp_karyawan;
        $this->takenKaryawan  = $karyawan->taken;
        $this->activeKaryawan = $karyawan->active;
    }

    public function store()
    {
        $this->validate();
        try {
            $karyawan               = new Karyawan;
            $karyawan->npp_karyawan = $this->nppKaryawan;
            $karyawan->taken        = $this->takenKaryawan ?? 0;
            $karyawan->active       = $this->activeKaryawan ?? 0;
            $karyawan->save();
            if ($karyawan) {
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
        $this->validate();
        try {
            $karyawan               = Karyawan::find($this->id);
            $karyawan->npp_karyawan = $this->nppKaryawan;
            $karyawan->taken        = $this->takenKaryawan;
            $karyawan->active       = $this->activeKaryawan;
            $karyawan->save();
            $this->reset();

            return $karyawan;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
