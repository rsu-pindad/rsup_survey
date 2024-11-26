<?php

namespace App\Livewire\Admin\Unit;

use App\Livewire\Forms\UnitForm as Form;
use App\Models\Unit;

use Livewire\Attributes\Locked;
use Livewire\Component;

class UnitEdit extends Component
{
    

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->unit = Unit::findOrFail($id);
        $this->form->setUnit($this->unit);
    }

    public function render()
    {
        return view('livewire.admin.unit.unit-edit');
    }

    public function edit()
    {
        $this->form->validate();
        $update = $this->form->update();
        if ($update != true) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
        return $this->flash('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data unit berhasil diperbarui',
        ], route('root-unit'));
    }
}
