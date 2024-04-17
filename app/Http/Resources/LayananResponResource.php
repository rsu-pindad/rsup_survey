<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Layanan;
use App\Models\Respon;

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
            'nama_layanan' => Layanan::find($this->layanan_id)->nama_layanan,
            'nama_respon' => Respon::find($this->respon_id)->nama_respon,
            'skor_respon' => Respon::find($this->respon_id)->skor_respon,
        ];
    }
}
