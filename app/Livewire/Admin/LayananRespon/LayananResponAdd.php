<?php

namespace App\Livewire\Admin\LayananRespon;

use App\Livewire\Forms\LayananResponForm as Form;
use App\Models\Layanan;
use App\Models\Respon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LayananResponAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function save()
    {
        $this->form->validate();
        $store = $this->form->store();
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
            'text' => 'data layanan-respon berhasil ditambahkan',
        ]);
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.layanan-respon.layanan-respon-add')->with([
            'layanan' => Layanan::get(),
            'respon' => Respon::get(),
        ]);
    }
}
