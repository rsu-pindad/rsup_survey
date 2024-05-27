<?php

namespace App\Livewire\Admin\Respon;

use App\Models\Respon as ResponModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResponAdd extends Component
{
    use LivewireAlert;

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

    public function store()
    {
        $this->validate();
        try {
            $respon = new ResponModel;
            $respon->nama_respon = $this->namaRespon;
            $respon->icon_respon = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->skor_respon = $this->skorRespon;
            $respon->urutan_respon = $this->urutanRespon;
            $respon->save();
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function save()
    {
        $store = $this->store();
        if ($store != true) {
            $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $store,
            ]);
            return $this->dispatch('table-updated');
        }
        $this->alert('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data respon berhasil ditambahkan',
        ]);
        $this->reset();
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.respon.respon-add');
    }
}
