<?php

namespace App\Livewire\Admin;

use App\Http\Resources\PenjaminResource;
use App\Models\Penjamin as PenjaminModel;
use Livewire\Component;
// use Livewire\WithPagination;

class Penjamin extends Component
{
    // use WithPagination;

    public function render()
    {
        $penjamins = PenjaminModel::latest()->orderBy('unit_id')->get();
        return view('livewire.admin.penjamin')->with([
            'penjamins' => PenjaminResource::collection($penjamins),
        ]);
    }
}
