<?php

namespace App\Livewire\Admin;

use App\Http\Resources\PenjaminLayananResource;
use App\Models\PenjaminLayanan as PLModel;
use Livewire\Component;

class PenjaminLayanan extends Component
{
    public function render()
    {
        $pl = PLModel::latest()->orderBy('penjamin_id')->get();
        return view('livewire.admin.penjamin-layanan')->with([
            'penjaminLayanans' => PenjaminLayananResource::collection($pl),
        ]);
    }
}
