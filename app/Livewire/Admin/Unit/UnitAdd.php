<?php

namespace App\Livewire\Admin\Unit;

use App\Livewire\Forms\UnitForm as Form;
use App\Models\Unit;

use Livewire\Component;

class UnitAdd extends Component
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
            'text' => 'data unit berhasil ditambahkan',
        ]);
        $this->form->reset();
        return $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.unit.unit-add');
    }
}
