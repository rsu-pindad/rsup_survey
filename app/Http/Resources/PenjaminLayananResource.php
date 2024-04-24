<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Unit;

class PenjaminLayananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama_penjamin' => $this->parent_penjamin->nama_penjamin,
            'nama_layanan' => $this->parent_layanan->nama_layanan,
            'nama_unit' => Unit::find($this->parent_penjamin->unit_id)->nama_unit,
        ];
    }
}
