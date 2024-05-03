<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\LayananEditForm as Form;
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

    public function render()
    {
        return view('livewire.admin.layanan-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data layana berhasil diperbarui'
            ], route('root-layanan'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update
            ]);
        }
    }
}
