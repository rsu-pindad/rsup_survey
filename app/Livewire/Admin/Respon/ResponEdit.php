<?php

namespace App\Livewire\Admin\Respon;

use App\Livewire\Forms\ResponForm as Form;
use App\Models\Respon;

use Livewire\Attributes\Locked;
use Livewire\Component;

class ResponEdit extends Component
{
    

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->respon = Respon::findOrFail($id);
        $this->form->setRespon($this->respon);
    }

    public function edit()
    {
        // $this->form->validate();
        $update = $this->form->update();
        if ($update === true) {
            return $this->flash('success', 'berhasil', [
                'position' => 'top',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'data respon berhasil diperbarui',
            ], route('root-respon'));
        }
        return $this->alert('error', 'gagal', [
            'position' => 'bottom',
            'timer' => '10000',
            'toast' => false,
            'text' => $update,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.respon.respon-edit');
    }
}
