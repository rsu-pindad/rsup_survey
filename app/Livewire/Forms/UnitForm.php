<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required', message: 'mohon isi nama unit')]
    #[Validate('min:4', message: 'minimal karakter 4')]
    #[Validate('max:50', message: 'maksimal karakter 50')]
    public $namaUnit;

    public $unit;
    public $multiPenilaian = false;

    public function setUnit(Unit $u)
    {
        $this->unit           = $u;
        $this->id             = $u->id;
        $this->namaUnit       = $u->nama_unit;
        $this->multiPenilaian = $u->multi_penilaian;
    }

    public function store()
    {
        try {
            $unit                  = new Unit;
            $unit->nama_unit       = $this->namaUnit;
            $unit->multi_penilaian = $this->multiPenilaian;
            $unit->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $unit                  = Unit::find($this->id);
            $unit->nama_unit       = $this->namaUnit;
            $unit->multi_penilaian = $this->multiPenilaian;
            if ($this->multiPenilaian == false) {
                $unit->pivotsMultiLayanan()->detach();
            }
            $unit->save();

            return $unit;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
