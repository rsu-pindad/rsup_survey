<?php

namespace App\Livewire\Admin\Penjamin;

use Livewire\Component;
use App\Models\Penjamin as PenjaminModel;
use App\Livewire\Forms\PenjaminEditForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;

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
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data penjamin berhasil ditambahkan',
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
        return view('livewire.admin.penjamin.penjamin-add');
    }
}
