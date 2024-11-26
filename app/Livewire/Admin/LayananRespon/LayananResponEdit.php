<?php

namespace App\Livewire\Admin\LayananRespon;

use App\Livewire\Forms\LayananResponForm as Form;
use App\Models\Layanan;
use App\Models\LayananRespon;
use App\Models\Respon;

use Livewire\Attributes\Locked;
use Livewire\Component;

class LayananResponEdit extends Component
{
    

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->layananRespon = LayananRespon::findOrFail($id);
        $this->form->setLayananRespon($this->layananRespon);
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
            'text' => 'data-layanan-respon berhasil diperbarui'
        ], route('root-layanan-respon'));
    }

    public function render()
    {
        return view('livewire.admin.layanan-respon.layanan-respon-edit')->with([
            'layanan' => Layanan::get(),
            'respon' => Respon::get(),
        ]);
    }
}
