<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Karyawan;
use App\Models\Unit;

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
            'NPP' => Karyawan::find($this->karyawan_id)->npp_karyawan,
            'Unit' => Unit::find($this->unit_id)->nama_unit,
            'Nama' => $this->nama_karyawanprofile,
        ];
    }
}
