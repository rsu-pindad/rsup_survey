<?php

namespace App\Livewire\Guest;

use App\Models\Karyawan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Register extends Component
{
    use LivewireAlert;

    public Karyawan $karyawan;
    public $show        = false;
    public $showMessage = false;
    public $npp;
    public $getNpp;

    public function mount(Karyawan $karyawan)
    {
        $this->karyawan = $karyawan;
        $this->npp      = $karyawan->npp_karyawan;
    }

    public function updated($name, $value)
    {
        $findNpp = $this
                       ->karyawan
                       ->select('id', 'npp_karyawan')
                       ->where('npp_karyawan', $value)
                       ->where('taken', 0)
                       ->where('active', 1)
                       ->first();
        if ($findNpp) {
            $this->getNpp      = $findNpp->id;
            $this->show        = true;
            $this->showMessage = false;
        } else {
            // $this->npp = '';
            $this->show        = false;
            $this->showMessage = true;
        }
    }

    public function render()
    {
        return view('livewire.guest.register');
    }
}
