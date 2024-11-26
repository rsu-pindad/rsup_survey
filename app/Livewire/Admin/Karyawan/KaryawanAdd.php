<?php

namespace App\Livewire\Admin\Karyawan;

use Livewire\Component;
use App\Models\Karyawan;
use App\Livewire\Forms\KaryawanEditForm as Form;


class KaryawanAdd extends Component
{
    

    public Form $form;

    public function mount(Karyawan $karyawan)
    {
        $this->form->setKaryawan($karyawan);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan berhasil ditambahkan',
            ]);
            $this->dispatch('table-updated');
        } else {
            $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $store,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.karyawan.karyawan-add');
    }
}
