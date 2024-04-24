<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Unit as UnitModel;
Use App\Http\Resources\UnitResource;

class Unit extends Component
{
    public function render()
    {
        $units = UnitModel::latest()->get();
        return view('livewire.admin.unit')->with([
            'units' => UnitResource::collection($units),
        ]);
    }
}
