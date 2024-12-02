<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Livewire\Form;

class AuthForm extends Form
{
    public $email;
    public $password;
    public $remember;

    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'mohon masukan email',
            'email.email'       => 'mohon masukan email dengan benar',
            'password.required' => 'mohon masukan password',
        ];
    }

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

                return $auths;
            }
            $this->reset('password');

            return $auths;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
