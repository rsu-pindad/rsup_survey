<?php

namespace App\Livewire\Forms;

use App\Models\Respon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ResponEditForm extends Form
{
    #[Locked]
    public $id;

    #[Validate('required')]
    public $namaRespon;

    #[Validate('required')]
    public $iconRespon;

    #[Validate('required')]
    public $tagWarnaRespon;

    #[Validate('required')]
    public $skorRespon;

    #[Validate('required')]
    public $urutanRespon;

    public function setRespon(Respon $respon)
    {
        $this->respon = $respon;
        $this->id = $respon->id;
        $this->namaRespon = $respon->nama_respon;
        $this->iconRespon = $respon->icon_respon;
        $this->tagWarnaRespon = $respon->tag_warna_respon;
        $this->skorRespon = $respon->skor_respon;
        $this->urutanRespon = $respon->urutan_respon;
    }

    public function store()
    {
        $this->validate();
        try {
            $respon = new Respon;
            $respon->nama_respon = $this->namaRespon;
            $respon->icon_respon = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->skor_respon = $this->skorRespon;
            $respon->urutan_respon = $this->urutanRespon;
            $respon->save();
            if($respon){
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
            $respon = Respon::find($this->id);
            $respon->nama_respon = $this->namaRespon;
            $respon->icon_respon = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->skor_respon = $this->skorRespon;
            $respon->urutan_respon = $this->urutanRespon;
            $respon->save();
            $this->reset();
            return $respon;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
