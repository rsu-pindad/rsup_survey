<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\AuthForm;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    use LivewireAlert;

    public AuthForm $form;

    public function login()
    {
        $this->form->validate();
        $auth = $this->form->auth();
        if ($auth === true) {
            return redirect()->intended('/');
        }
        $this->form->reset('password');
        return $this->alert('warning', 'Gagal', [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
            'text' => 'email atau password salah !',
            'timerProgressBar' => true,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->flash('info', 'selamat tinggal', [
            'position' => 'top',
        ], route('login'));
    }

    #[Title('Masuk')]
    public function render()
    {
        return view('livewire.auth.login')->with([
            'appSetting' => AppSetting::get()->last(),
        ]);
    }
}
