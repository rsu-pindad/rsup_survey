<?php

namespace App\Livewire\Forms;

use App\Models\LayananRespon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LayananResponEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $idLayanan;

    #[Validate('required')]
    public $idRespon;

    public function setLayananRespon(LayananRespon $layananRepson)
    {
        $this->layananRepson = $layananRepson;
        $this->id = $layananRepson->id;
        $this->idLayanan = $layananRepson->layanan_id;
        $this->idRespon = $layananRepson->respon_id;
    }

    public function store()
    {
        $this->validate();
        try {
            $layananRepson = new LayananRespon;
            $layananRepson->layanan_id = $this->idLayanan;
            $layananRepson->respon_id = $this->idRespon;
            $layananRepson->save();
            if ($layananRepson) {
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
            $layananRepson = LayananRespon::find($this->id);
            $layananRepson->layanan_id = $this->idLayanan;
            $layananRepson->respon_id = $this->idRespon;
            $layananRepson->save();
            $this->reset();
            return $layananRepson;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

}
