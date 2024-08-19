<?php

namespace App\Livewire\Admin\Respon;

use Livewire\Component;
use App\Models\Respon as ResponModel;
use App\Http\Resources\ResponResource;

class Respon extends Component
{
    public function render()
    {
        $respons = ResponModel::latest()->get();
        return view('livewire.admin.respon.respon')->with([
            'respons' => ResponResource::collection($respons)
        ]);
    }
}
