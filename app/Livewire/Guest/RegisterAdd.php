<?php

namespace App\Livewire\Guest;

use App\Livewire\Forms\RegisterForm as Form;
use App\Models\Layanan;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RegisterAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    protected $listeners = [
        'confirmed',
        'cancalled'
    ];

    public function mount($getNpp)
    {
        $this->form->getNpp = $getNpp;
    }

    public function preStore()
    {
        // $this->validateOnly('namaKaryawan');
        // try {
        //     $store = $this->form->store();
        //     if ($store) {
        //         return $this->flash('success', 'registrasi berhasil silahkan masuk', [
        //             'position' => 'center',
        //         ], route('login'));
        //     } else {
        //         return $this->alert('warning', 'Gagal', [
        //             'position' => 'center',
        //             'timer' => 2000,
        //             'toast' => true,
        //             'text' => $store,
        //             'timerProgressBar' => true,
        //         ]);
        //     }
        // } catch (\Throwable $th) {
        //     return $th->getMessage();
        // }
        $this->confirm('Anda yakin telah mengisi data dengan benar ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Iya',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        // $this->validate(['email','password','namaKaryawan']);
        try {
            $store = $this->form->store();
            if ($store['status'] == true) {
                return $this->flash('success', $store['message'], [
                    'position' => 'center',
                ], route('login'));
            }
            return $this->alert('warning', 'Gagal', [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'text' => $store['message'],
                'timerProgressBar' => true,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.guest.register-add')->with([
            'unit' => Unit::get(),
            'layanan' => Layanan::get(),
        ]);
    }
}
