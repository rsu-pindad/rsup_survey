<?php

namespace App\Livewire\Admin\Respon;

use App\Livewire\Forms\ResponForm as Form;
use App\Models\Respon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ResponEdit extends Component
{
    use LivewireAlert;

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
            'position' => 'center',
            'toast' => true,
            'text' => 'data respon berhasil diperbarui',
        ], route('root-respon'));
    }

    public function render()
    {
        return view('livewire.admin.respon.respon-edit');
    }
}
