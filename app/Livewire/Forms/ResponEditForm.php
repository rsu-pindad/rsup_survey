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

    #[Validate('required', message: 'mohon isi nama respon')]
    #[Validate('min:4', message: 'minimal karakter 4')]
    #[Validate('max:50', message: 'maksimal karakter 50')]
    public $namaRespon;

    #[Validate('required', message: 'mohon isi icon respon')]
    #[Validate('min:6', message: 'minimal karakter 6')]
    #[Validate('max:32', message: 'maksimal karakter 32')]
    public $iconRespon;

    #[Validate('required', message: 'mohon isi skor respon')]
    #[Validate('numeric')]
    #[Validate('min:0', message: 'minimal angka 0')]
    #[Validate('max:9', message: 'maksimal angka 9')]
    public $skorRespon;

    #[Validate('required', message: 'mohon isi urutan respon')]
    #[Validate('numeric')]
    #[Validate('min:1', message: 'minimal angka 1')]
    #[Validate('max:10', message: 'maksimal angka 10')]
    public $urutanRespon;

    #[Validate('required', message: 'mohon isi tag warna respon')]
    public $tagWarnaRespon;

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
            // report($th);
            // return false;
            return $th->getMessage();
        }
    }
}
