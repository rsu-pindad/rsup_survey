<?php

namespace App\Livewire\Admin\Respon;

use Livewire\Component;
use App\Models\Respon as ResponModel;
use App\Livewire\Forms\ResponEditForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResponAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(ResponModel $respon)
    {
        $this->form->setRespon($respon);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data respon berhasil ditambahkan',
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
        return view('livewire.admin.respon.respon-add');
    }
}
