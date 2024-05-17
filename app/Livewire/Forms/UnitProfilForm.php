<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use App\Models\UnitProfil;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class UnitProfilForm extends Form
{
    use WithFileUploads;

    // #[Locked]
    public $unitId;

    public $unitMainLogo;

    public $unitSubLogo;

    public $unitMainLogoOld;

    public $unitSubLogoOld;

    public $unitMotto;

    public $unitAlamat;

    public $unitNama;

    public function setUnit($id)
    {
        $unit = Unit::find($id);
        $this->unitId = $unit->id;
        $this->unitNama = $unit->nama_unit;
        $unitProfil = UnitProfil::where('unit_id', $this->unitId)->first();
        $this->unitMainLogoOld = $unitProfil->unit_main_logo ?? '';
        $this->unitSubLogoOld = $unitProfil->unit_sub_logo ?? '';
        $this->unitAlamat = $unitProfil->unit_alamat ?? '';
        $this->unitMotto = $unitProfil->unit_motto ?? '';
    }

    public function store()
    {
        // dd($this->all());
        try {
            
            $mainName = $this->unitMainLogo[0]['name'];
            $subName = $this->unitSubLogo[0]['name'];
            
            $main = Storage::putFileAs('/public/basset/photos', new File($this->unitMainLogo[0]['path']), $mainName);
            $sub = Storage::putFileAs('/public/basset/photos', new File($this->unitSubLogo[0]['path']), $subName);
            // dd($main);
            $unitProfil = UnitProfil::updateOrCreate(
                [
                    'unit_id' => $this->unitId,
                ],
                [
                    'unit_main_logo' => $mainName ?? $this->unitMainLogoOld,
                    'unit_sub_logo' => $subName ?? $this->unitMainLogoOld,
                    'unit_alamat' => $this->unitAlamat,
                    'unit_motto' => $this->unitMotto,
                ]
            );
            // Storage::delete('/tmp');
            return $unitProfil;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
