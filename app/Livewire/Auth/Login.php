<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Models\AppSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    public LoginForm $form;

    public function login()
    {
        $this->form->checkAuth();
        if (!Auth::attempt($this->form->all())) {
            $this->form->reset('password');
            return $this->alert('warning', 'Gagal', [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'text' => 'email atau password salah !',
                'timerProgressBar' => true,
            ]);
        }
        Carbon::setLocale('id');
        $time = Carbon::now()->setTimezone('Asia/Jakarta');
        session()->regenerate();
        session()->put('userName', Auth::user()->name);
        session()->put('userId', Auth::user()->id);
        $user = User::find(Auth::user()->id);
        $user->last_login = $time;
        $user->save();
        return redirect()->intended('/');
    }
    
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->flash('info', 'selamat tinggal', [
            'position' => 'center',
        ], route('login'));
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
        return view('livewire.auth.login')->with([
            'appSetting' => AppSetting::get()->last(),
        ]);
    }
}
