<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\LayananRespon as LRModel;
use App\Http\Resources\LayananResponResource;

class LayananRespon extends Component
{
    public function render()
    {
        $lr = LRModel::latest()->orderBy('layanan_id')->get();
        return view('livewire.admin.layanan-respon')->with([
            'layananRespons' => LayananResponResource::collection($lr),
        ]);
    }
}
