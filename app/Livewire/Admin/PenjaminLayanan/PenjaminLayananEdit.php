<?php

namespace App\Livewire\Admin\PenjaminLayanan;

use App\Livewire\Forms\PenjaminLayananForm as Form;
use App\Models\Layanan;
use App\Models\Penjamin;
use App\Models\PenjaminLayanan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PenjaminLayananEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->penjaminLayanan = PenjaminLayanan::findOrFail($id);
        $this->form->setPenjaminLayanan($this->penjaminLayanan);
    }

    public function edit()
    {
        $this->form->validate();
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'postion' => 'center',
                'toast' => true,
                'text' => 'data penjamin-layanan berhasil diperbarui'
            ], route('root-penjamin-layanan'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.penjamin-layanan.penjamin-layanan-edit')->with([
            'penjamin' => Penjamin::get(),
            'layanan' => Layanan::get()
        ]);
    }
}
