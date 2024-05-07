<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;

class Login extends Component
{
    use LivewireAlert;

    public LoginForm $form;

    public function login()
    {
        $this->form->checkAuth();
        if (Auth::attempt($this->form->all())) {
            \Carbon\Carbon::setLocale('id');
            $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
            session()->regenerate();
            session()->put('userName', Auth::user()->name);
            session()->put('userId', Auth::user()->id);
            $user = User::find(Auth::user()->id);
            $user->last_login = $time;
            $user->save();
            return redirect()->intended('/');
        } else {
            $this->form->reset('password');
            $this->alert('warning', 'Gagal', [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'text' => 'email atau password salah !',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div>
                <!-- Loading spinner... -->
                <svg>...</svg>
            </div>
            HTML;
    }

    #[Title('Masuk')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
