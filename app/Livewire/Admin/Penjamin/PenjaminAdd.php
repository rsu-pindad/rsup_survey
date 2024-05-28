<?php

namespace App\Livewire\Admin\Penjamin;

use App\Livewire\Forms\PenjaminEditForm as Form;
use App\Models\Penjamin as PenjaminModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PenjaminAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(PenjaminModel $penjamin)
    {
        $this->form->setPenjamin($penjamin);
    }

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
        }
        $this->alert('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data penjamin berhasil ditambahkan',
        ]);
        $this->dispatch('table-updated');
    }

    public function render()
    {
        return view('livewire.admin.penjamin.penjamin-add');
    }
}
