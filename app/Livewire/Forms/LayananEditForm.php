<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attribures\Locked;
use App\Models\Layanan;

class LayananEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaLayanan;

    public function setLayanan(Layanan $layanan)
    {
        $this->layanan = $layanan;
        $this->id = $layanan->id;
        $this->namaLayanan = $layanan->nama_layanan;
    }

    public function store()
    {
        $this->validate();
        try {
            $layanan = new Layanan;
            $layanan->nama_layanan = $this->namaLayanan;
            $layanan->save();
            if($layanan){
                $this->reset();
                return true;
            }else{
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
            $layanan = Layanan::find($this->id);
            $layanan->nama_layanan = $this->namaLayanan;
            $layanan->save();
            $this->reset();
            return $layanan;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

}
