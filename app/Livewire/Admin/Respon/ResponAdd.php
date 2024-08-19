<?php

namespace App\Livewire\Admin\Respon;

use App\Livewire\Forms\ResponForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ResponAdd extends Component
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
            'text' => 'data respon berhasil ditambahkan',
        ]);
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.respon.respon-add');
    }
}
