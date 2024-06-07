<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AuthForm extends Form
{
    #[Validate('required', message: 'mohon isi alamat email')]
    #[Validate('email', message: 'email tidak valid')]
    public $email;

    #[Validate('required', message: 'mohon isi password')]
    public $password;

    #[Locked]
    public $remember;

    #[Locked]
    public $time;

    public function mount()
    {
        Carbon::setLocale('id');
        $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
    }

    public function auth()
    {
        if (Auth::viaRemember()) {
            return redirect()->intended('/');
        }
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            session()->put('userName', Auth::user()->name);
            session()->put('userId', Auth::user()->id);

            $user = User::find(session()->get('userId'));
            $user->last_login = $this->time;
            $user->save();
            return true;
        }
        return false;
    }
}
