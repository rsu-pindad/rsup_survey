<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public $title = 'Masuk';

    public function login()
    {
        if (Auth::attempt($this->form->all())) {
            session()->regenerate();
            // $user = User::where('email', $this->form->only('email'))->first();
            // $user->update(['last_login' => Carbon::now()]);
            return redirect()->intended('/');
        } else {
            session()->flash('error', 'email and password are wrong.');
            // throw ValidationException::withMessages([
            //     // 'email' => 'email ata password salah'
            //     'error' => 'email atau password salah'
            // ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
