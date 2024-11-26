<?php

namespace App\Livewire\Admin\Layanan;

use App\Livewire\Forms\LayananForm as Form;

use Livewire\Component;

class LayananAdd extends Component
{
    

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
            'text' => 'data layanan berhasil ditambahkan',
        ]);
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.layanan.layanan-add');
    }
}
