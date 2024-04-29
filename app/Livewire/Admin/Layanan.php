<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Resources\LayananResource;
use App\Models\Layanan as LayananModel;
// use Livewire\WithPagination;

class Layanan extends Component
{
    // use WithPagination;

    public function render()
    {
        $layanans = LayananModel::latest()->get();
        return view('livewire.admin.layanan')->with([
            'layanans' => LayananResource::collection($layanans),
        ]);
    }
}
