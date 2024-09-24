<?php

namespace App\Livewire\Sdm;

use App\Models\Respon;
use Livewire\Component;

class Laporan extends Component
{
    public function render()
    {
        $responTable = Respon::get();

        return view('livewire.sdm.laporan')->with([
            'library' => 'chartjs',
            'title'   => 'Respon Title',
            'builder' => $responTable,
            'poll'    => 2,
            'width'   => 500,
            'height'  => 250,
        ]);
    }
}
