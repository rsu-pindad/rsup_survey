<?php

namespace App\Livewire\Admin\Layanan;

use Livewire\Component;
use App\Models\Layanan as LayananModel;
use App\Livewire\Forms\LayananEditForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LayananAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(LayananModel $layanan)
    {
        $this->form->setLayanan($layanan);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data layanan berhasil ditambahkan',
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
        return view('livewire.admin.layanan.layanan-add');
    }
}
