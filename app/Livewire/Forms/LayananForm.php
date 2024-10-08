<?php

namespace App\Livewire\Forms;

use App\Models\Layanan;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LayananForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required', message: 'mohon isi nama layanan')]
    #[Validate('min:5', message: 'minimal karakter 5')]
    #[Validate('max:50', message: 'maksimal karakter 50')]
    public $namaLayanan;

    public $multiLayanan = false;
    public $layanan;

    public function setLayanan(Layanan $l)
    {
        $this->layanan      = $l;
        $this->id           = $l->id;
        $this->namaLayanan  = $l->nama_layanan;
        $this->multiLayanan = $l->multi_layanan;
    }

    public function store()
    {
        try {
            $layanan                = new Layanan;
            $layanan->nama_layanan  = $this->namaLayanan;
            $layanan->multi_layanan = $this->multiLayanan;
            $layanan->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $layanan                = Layanan::find($this->id);
            $layanan->nama_layanan  = $this->namaLayanan;
            $layanan->multi_layanan = $this->multiLayanan;
            $layanan->save();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
