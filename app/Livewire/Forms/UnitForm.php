<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Unit;

class UnitForm extends Form
{
    #[Validate('required')]
    public $namaUnit;

    public function store()
    {
        $this->validate();
        try {
            $unit = new Unit;
            $unit->nama_unit = $this->namaUnit;
            $unit->save();
            $this->reset(); 
            return $unit;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
