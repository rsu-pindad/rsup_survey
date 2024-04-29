<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanProfileResource extends JsonResource
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
            'NPP' => $this->parentKaryawan->npp_karyawan,
            'Unit' => $this->parentUnit->nama_unit,
            'Layanan' => $this->parentLayanan->nama_layanan,
            'Nama' => $this->nama_karyawanprofile,
        ];
    }
}
