<?php

namespace App\Livewire\Admin\PenjaminLayanan;

use App\Livewire\Forms\PenjaminLayananForm as Form;
use App\Models\Layanan;
use App\Models\Penjamin;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PenjaminLayananAdd extends Component
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
            'text' => 'data penjamin-layanan berhasil ditambahkan',
        ]);
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.penjamin-layanan.penjamin-layanan-add')->with([
            'penjamin' => Penjamin::get(),
            'layanan' => Layanan::get(),
        ]);
    }
}
