<?php

namespace App\Livewire\Admin\Respon;

use App\Livewire\Forms\ResponEditForm as Form;
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

    public function render()
    {
        return view('livewire.admin.respon.respon-edit');
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
