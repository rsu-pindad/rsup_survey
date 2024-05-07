<?php

namespace App\Livewire\Admin\LayananRespon;

use App\Livewire\Forms\LayananResponEditForm as Form;
use App\Models\Layanan;
use App\Models\LayananRespon;
use App\Models\Respon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LayananResponAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(LayananRespon $layananRespon)
    {
        $this->form->setLayananRespon($layananRespon);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data layanan-respon berhasil ditambahkan',
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
        return view('livewire.admin.layanan-respon.layanan-respon-add')->with([
            'layanan' => Layanan::get(),
            'respon' => Respon::get(),
        ]);
    }
}
