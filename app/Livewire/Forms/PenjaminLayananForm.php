<?php

namespace App\Livewire\Forms;

use App\Models\PenjaminLayanan;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PenjaminLayananForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required', message: 'pilih nama penjamin')]
    public $idPenjamin;

    #[Validate('required', message: 'pilih nama layanan')]
    public $idLayanan;

    public function setPenjaminLayanan(PenjaminLayanan $penjaminLayanan)
    {
        $this->penjaminLayanan = $penjaminLayanan;
        $this->id = $penjaminLayanan->id;
        $this->idPenjamin = $penjaminLayanan->penjamin_id;
        $this->idLayanan = $penjaminLayanan->layanan_id;
    }

    public function store()
    {
        try {
            $penjaminLayanan = new PenjaminLayanan;
            $penjaminLayanan->penjamin_id = $this->idPenjamin;
            $penjaminLayanan->layanan_id = $this->idLayanan;
            $penjaminLayanan->save();
            $this->reset();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $penjaminLayanan = PenjaminLayanan::find($this->id);
            $penjaminLayanan->penjamin_id = $this->idPenjamin;
            $penjaminLayanan->layanan_id = $this->idLayanan;
            $penjaminLayanan->save();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
