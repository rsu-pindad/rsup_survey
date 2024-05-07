<?php

namespace App\Livewire\Guest;

use App\Livewire\Forms\RegisterForm as Form;
use App\Models\Layanan;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterAdd extends Component
{
    use LivewireAlert;

    public Form $form;

    protected $listeners = [
        'confirmed',
        'cancalled'
    ];

    #[Validate('required')]
    public $getNpp;

    #[Validate('required')]
    public $idUnit;

    #[Validate('required')]
    public $idLayanan;

    #[Validate('required')]
    public $namaKaryawan;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:5')]
    public $password;

    public function mount($getNpp)
    {
        $this->getNpp = $getNpp;
    }

    public function preStore()
    {
        // $this->validateOnly('namaKaryawan');
        // dd($this->getNpp,$this->namaKaryawan,$this->idUnit,$this->idLayanan,$this->email,$this->password);
        try {
            $store = $this->form->store(
                $this->getNpp,
                $this->namaKaryawan,
                $this->idUnit,
                $this->idLayanan,
                $this->email,
                $this->password
            );
            // dd($store);
            if ($store) {
                return $this->flash('success', 'registrasi berhasil silahkan masuk', [
                    'position' => 'center',
                ], route('login'));
            } else {
                $this->alert('warning', 'Gagal', [
                    'position' => 'center',
                    'timer' => 2000,
                    'toast' => true,
                    'text' => 'terjadi kesalahan',
                    'timerProgressBar' => true,
                ]);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        // $this->confirm('Anda yakin telah mengisi data yang benar ?', [
        //     'icon' => 'question',
        //     'onConfirmed' => 'confirmed',
        //     'allowOutsideClick' => false,
        //     'confirmButtonText' => 'Iya',
        //     'cancelButtonText' => 'Batal',
        //     'onDismissed' => 'cancelled'
        // ]);
    }

    public function confirmed()
    {
        $this->validateOnly('namaKaryawan');
        try {
            $store = $this->form->store($this->getNpp, $this->namaKaryawan, $this->idUnit, $this->idLayanan);
            if ($store) {
                return $this->flash('success', 'registrasi berhasil silahkan masuk', [
                    'position' => 'center',
                ], route('login'));
            } else {
                $this->alert('warning', 'Gagal', [
                    'position' => 'center',
                    'timer' => 2000,
                    'toast' => true,
                    'text' => 'terjadi kesalahan',
                    'timerProgressBar' => true,
                ]);
            }
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
