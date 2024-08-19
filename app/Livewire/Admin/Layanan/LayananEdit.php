<?php

namespace App\Livewire\Admin\Layanan;

use App\Livewire\Forms\LayananForm as Form;
use App\Models\Layanan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attribures\Locked;
use Livewire\Component;

class LayananEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->layanan = Layanan::findOrFail($id);
        $this->form->setLayanan($this->layanan);
    }

    public function edit()
    {
        $this->form->validate();
        $update = $this->form->update();
        if ($update != true) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update
            ]);
        }
        return $this->flash('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data layanan berhasil diperbarui'
        ], route('root-layanan'));
    }

    public function render()
    {
        return view('livewire.admin.layanan.layanan-edit');
    }
}
