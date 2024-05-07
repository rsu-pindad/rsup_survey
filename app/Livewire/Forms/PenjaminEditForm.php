<?php

namespace App\Livewire\Forms;

use App\Models\Penjamin;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PenjaminEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaPenjamin;

    public function setPenjamin(Penjamin $penjamin)
    {
        $this->penjamin = $penjamin;
        $this->id = $penjamin->id;
        $this->namaPenjamin = $penjamin->nama_penjamin;
    }

    public function store()
    {
        $this->validate();
        try {
            $penjamin = new Penjamin;
            $penjamin->nama_penjamin = $this->namaPenjamin;
            $penjamin->save();
            if ($penjamin) {
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
        try {
            $penjamin = Penjamin::find($this->id);
            $penjamin->nama_penjamin = $this->namaPenjamin;
            $penjamin->save();
            $this->reset();
            return $penjamin;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
