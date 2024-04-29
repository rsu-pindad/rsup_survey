<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:5')]
    public $password;

    public function checkAuth()
    {
        return $this->validate();
    }

}
