<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class RootsNavbarMobile extends Component
{
    public $unitAlamat;

    public $subLogo;

    public $layanan;

    public $petugas;

    public function mount($unitAlamat, $layanan, $petugas)
    {
        $this->unitAlamat = $unitAlamat;
        $this->layanan = $layanan;
        $this->petugas = $petugas;
    }

    public function render()
    {
        return view('livewire.admin.roots-navbar-mobile')
            ->extends('components.layouts.beranda')
            ->section('navbars');
    }
}
