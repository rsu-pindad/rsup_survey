<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
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

    public function store()
    {
        try {
            $unit = new Unit;
            $unit->nama_unit = $this->namaUnit;
            $unit->save();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
