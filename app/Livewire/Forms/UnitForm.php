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

    public $multiPenilaian = false;

    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;
        $this->id = $unit->id;
        $this->namaUnit = $unit->nama_unit;
        $this->multiPenilaian = $unit->multi_penilaian;
    }

    public function store()
    {
        try {
            $unit = new Unit;
            $unit->nama_unit = $this->namaUnit;
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
            $unit = Unit::find($this->id);
            $unit->nama_unit = $this->namaUnit;
            $unit->multi_penilaian = $this->multiPenilaian;
            $unit->save();
            return $unit;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
