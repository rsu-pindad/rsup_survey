<?php

namespace App\Livewire\Admin\KaryawanProfile;

use Livewire\Component;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Unit;
use App\Models\Layanan;
use App\Models\KaryawanProfile;
use App\Livewire\Forms\KaryawanProfileEditForm as Form;


class KaryawanProfileAdd extends Component
{
    

    public Form $form;

    public function mount(KaryawanProfile $karyawanProfile)
    {
        $this->form->setKaryawanProfile($karyawanProfile);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data karyawan profile ditambahkan',
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
        return view('livewire.admin.karyawan-profile.karyawan-profile-add')->with([
            'user' => User::get(),
            'karyawan' => Karyawan::where('taken', 0)->where('active', 0)->get(),
            'unit' => Unit::get(),
            'layanan' => Layanan::get(),
        ]);
    }
}
