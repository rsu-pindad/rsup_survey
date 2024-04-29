<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LayananResponResource extends JsonResource
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
            'nama_layanan' => $this->parent_layanan->nama_layanan,
            'nama_respon' => $this->parent_respon->nama_respon,
            'skor_respon' => $this->parent_respon->skor_respon,
        ];
    }
}
