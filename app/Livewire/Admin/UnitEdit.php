<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\UnitEditForm as Form;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UnitEdit extends Component
{
    use LivewireAlert;

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
        return view('livewire.admin.unit-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data unit berhasil diperbarui',
            ], route('root-unit'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }
}
