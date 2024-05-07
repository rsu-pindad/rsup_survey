<?php

namespace App\Livewire\Admin\Unit;

use App\Livewire\Forms\UnitEditForm as Form;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UnitAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(Unit $unit)
    {
        $this->form->setUnit($unit);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data unit berhasil ditambahkan',
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
        return view('livewire.admin.unit.unit-add');
    }
}
