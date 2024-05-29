<?php

namespace App\Livewire\Admin\Penjamin;

use App\Livewire\Forms\PenjaminForm as Form;
use App\Models\Penjamin;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PenjaminEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->penjamin = Penjamin::findOrFail($id);
        $this->form->setPenjamin($this->penjamin);
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
            'postion' => 'center',
            'toast' => true,
            'text' => 'data penjamin berhasil diperbarui'
        ], route('root-penjamin'));
    }

    public function render()
    {
        return view('livewire.admin.penjamin.penjamin-edit');
    }
}
