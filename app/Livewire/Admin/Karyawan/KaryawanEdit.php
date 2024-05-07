<?php

namespace App\Livewire\Admin\Karyawan;

use Livewire\Component;
use App\Livewire\Forms\KaryawanEditForm as Form;
use App\Models\Karyawan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attribures\Locked;

class KaryawanEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->karyawan = Karyawan::findOrFail($id);
        $this->form->setKaryawan($this->karyawan);
    }

    public function render()
    {
        return view('livewire.admin.karyawan.karyawan-edit');
    }

    public function edit()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan berhasil diperbarui'
            ], route('root-karyawan'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update
            ]);
        }
    }
}
