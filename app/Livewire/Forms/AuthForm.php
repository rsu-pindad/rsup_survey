<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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

    public function auth()
    {
        $this->validate();
        try {
            if (Auth::viaRemember()) {
                return redirect()->intended('/');
            }
            $auths = Auth::attempt(
                [
                    'email'    => $this->email,
                    'password' => $this->password
                ],
                $this->remember
            );
            if ($auths) {
                session()->regenerate();
                Auth::user()->update([
                    'last_login' => Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString()
                ]);

                return true;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
