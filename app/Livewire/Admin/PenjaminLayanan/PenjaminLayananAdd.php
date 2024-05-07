<?php

namespace App\Livewire\Admin\PenjaminLayanan;

use App\Livewire\Forms\PenjaminLayananEditForm as Form;
use App\Models\Layanan;
use App\Models\Penjamin;
use App\Models\PenjaminLayanan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PenjaminLayananAdd extends Component
{
    use LivewireAlert;
    
    public Form $form;

    public function mount(PenjaminLayanan $penjaminLayanan)
    {
        $this->form->setPenjaminLayanan($penjaminLayanan);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data penjamin-layanan berhasil ditambahkan',
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
        return view('livewire.admin.penjamin-layanan.penjamin-layanan-add')->with([
            'penjamin' => Penjamin::get(),
            'layanan' => Layanan::get(),
        ]);
    }
}
