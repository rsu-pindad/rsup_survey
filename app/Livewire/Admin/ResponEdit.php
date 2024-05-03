<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ResponEditForm as Form;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use App\Models\Respon;

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

    public function render()
    {
        return view('livewire.admin.respon-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data respon berhasil diperbarui',
            ], route('root-respon'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update,
            ]);
        }
    }
}
