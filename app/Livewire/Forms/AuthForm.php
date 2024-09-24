<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

    public $remember;
    public $time;
    public $timeformat;

    public function auth()
    {
        Carbon::setLocale('id');
        Cache::flush();
        $this->time       = Carbon::now()->setTimezone('Asia/Jakarta');
        $this->timeformat = Carbon::parse($this->time);
        if (Auth::viaRemember()) {
            return redirect()->intended('/');
        }
        $auths = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
        if ($auths === true) {
            session()->regenerate();
            session()->put('userName', Auth::user()->name);
            session()->put('userId', Auth::id());

            $user             = User::find(Auth::id());
            $user->last_login = $this->timeformat;
            $user->save();

            return true;
        }

        return false;
    }
}
