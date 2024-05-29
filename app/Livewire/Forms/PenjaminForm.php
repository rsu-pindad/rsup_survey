<?php

namespace App\Livewire\Forms;

use App\Models\Penjamin;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PenjaminForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required', message: 'mohon isi nama penjamin')]
    #[Validate('min:4', message: 'minimal karakter 4')]
    #[Validate('max:50', message: 'maksimal karakter 50')]
    public $namaPenjamin;

    public function setPenjamin(Penjamin $penjamin)
    {
        $this->penjamin = $penjamin;
        $this->id = $penjamin->id;
        $this->namaPenjamin = $penjamin->nama_penjamin;
    }

    public function store()
    {
        try {
            $penjamin = new Penjamin;
            $penjamin->nama_penjamin = $this->namaPenjamin;
            $penjamin->save();
            $this->reset();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $penjamin = Penjamin::find($this->id);
            $penjamin->nama_penjamin = $this->namaPenjamin;
            $penjamin->save();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
