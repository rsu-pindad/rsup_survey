<?php

namespace App\Livewire\Admin\Penjamin;

use App\Livewire\Forms\PenjaminForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PenjaminAdd extends Component
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
        }
        $this->alert('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data penjamin berhasil ditambahkan',
        ]);
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.penjamin.penjamin-add');
    }
}
