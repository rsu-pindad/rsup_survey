<?php

namespace App\Livewire\Admin\KaryawanProfile;

use App\Livewire\Forms\KaryawanProfileEditForm as Form;
use App\Models\Karyawan;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\Unit;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attribures\Locked;
use Livewire\Component;

class KaryawanProfileEdit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    public function mount($id)
    {
        $this->karyawanProfile = KaryawanProfile::findOrFail($id);
        $this->form->setKaryawanProfile($this->karyawanProfile);
    }

    public function render()
    {
        return view('livewire.admin.karyawan-profile.karyawan-profile-edit')->with([
            'user' => User::get(),
            'karyawan' => Karyawan::where('taken', 0)->where('active', 0)->get(),
            'unit' => Unit::get(),
            'layanan' => Layanan::get(),
        ]);
    }

    public function edit()
    {
        $update = $this->form->update();
        // dd($update);
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan profile berhasil diperbarui'
            ], route('root-karyawan-profile'));
        } else {
            // dd($update);
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $update
            ]);
        }
    }
}
