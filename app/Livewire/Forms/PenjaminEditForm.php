<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Form;
use App\Models\Penjamin;

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
