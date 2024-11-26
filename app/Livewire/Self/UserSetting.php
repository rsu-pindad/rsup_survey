<?php

namespace App\Livewire\Self;

use App\Livewire\Forms\UserProfileForm as ProfileForm;
use App\Models\KaryawanProfile;
use App\Models\User;

use Livewire\Component;

class UserSetting extends Component
{
    

    public ProfileForm $profileForm;

    public function mount()
    {
        $userId     = session()->get('userId');
        $karyawanId = KaryawanProfile::where('user_id', $userId)->first();
        $this->profileForm->setProfile($karyawanId->id);
        $this->profileForm->setUser($userId);
    }

    public function edit()
    {
        $update = $this->profileForm->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast'    => true,
                'text'     => 'profile berhasil diperbarui',
            ], route('root-self'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast'    => true,
                'text'     => $update,
            ]);
        }
    }

    public function editUser()
    {
        $update = $this->profileForm->updateUser();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast'    => true,
                'text'     => 'profile email berhasil diperbarui',
            ], route('root-self'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast'    => true,
                'text'     => $update,
            ]);
        }
    }

    public function render()
    {
        $user = User::findOrFail(session()->get('userId'));

        return view('livewire.self.user-setting')->with([
            'self' => $user,
        ]);
    }
}
