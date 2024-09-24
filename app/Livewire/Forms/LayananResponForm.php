<?php

namespace App\Livewire\Forms;

use App\Models\LayananRespon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LayananResponForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required', message: 'pilih nama layanan')]
    public $idLayanan;

    #[Validate('required', message: 'pilih nama respon')]
    public $idRespon;

    public $layananRepson;

    public function setLayananRespon(LayananRespon $lr)
    {
        $this->layananRepson = $lr;
        $this->id            = $lr->id;
        $this->idLayanan     = $lr->layanan_id;
        $this->idRespon      = $lr->respon_id;
    }

    public function store()
    {
        try {
            $layananRepson             = new LayananRespon;
            $layananRepson->layanan_id = $this->idLayanan;
            $layananRepson->respon_id  = $this->idRespon;
            $layananRepson->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            $layananRepson             = LayananRespon::find($this->id);
            $layananRepson->layanan_id = $this->idLayanan;
            $layananRepson->respon_id  = $this->idRespon;
            $layananRepson->save();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
