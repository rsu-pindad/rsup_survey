<?php

namespace App\Livewire\Self;

use App\Livewire\Forms\UserProfileChangePasswordForm as FormPassword;

use Livewire\Component;

class UserChangePassword extends Component
{
    

    public FormPassword $form;

    public function mount()
    {
        $userId = session()->get('userId');
        $this->form->setUser($userId);
    }

    public function change()
    {
        $update = $this->form->update();
        if ($update) {
            return $this->flash('success', 'berhasil', [
                'position' => 'center',
                'toast'    => true,
                'text'     => 'password berhasil diperbarui',
            ], route('root-self'));
        } else {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast'    => true,
                'text'     => 'password lama salah',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.self.user-change-password');
    }
}
