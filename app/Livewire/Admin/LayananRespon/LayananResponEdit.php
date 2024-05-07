<?php

namespace App\Livewire\Admin\LayananRespon;

use App\Livewire\Forms\LayananResponEditForm as Form;
use App\Models\Respon;
use App\Models\Layanan;
use App\Models\LayananRespon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class LayananResponEdit extends Component
{
    use LivewireAlert;

    public Form $form;
    
    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->layananRespon = LayananRespon::findOrFail($id);
        $this->form->setLayananRespon($this->layananRespon);
    }

    public function render()
    {
        return view('livewire.admin.layanan-respon.layanan-respon-edit')->with([
            'layanan' => Layanan::get(),
            'respon' => Respon::get(),
        ]);
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'postion' => 'center',
                'toast' => true,
                'text' => 'data-layanan-respon berhasil diperbarui'
            ], route('root-layanan-respon'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }
}
