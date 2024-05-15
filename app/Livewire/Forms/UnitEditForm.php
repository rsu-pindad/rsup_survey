<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Unit;

class UnitEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaUnit;

    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;
        $this->id = $unit->id;
        $this->namaUnit = $unit->nama_unit;
    }

    public function store()
    {
        $this->validate();
        try {   
            $unit = new Unit;
            $unit->nama_unit = $this->namaUnit;
            $unit->save();
            if ($unit) {
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
            $unit = Unit::find($this->id);
            $unit->nama_unit = $this->namaUnit;
            $unit->save();
            $this->reset();
            return $unit;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
