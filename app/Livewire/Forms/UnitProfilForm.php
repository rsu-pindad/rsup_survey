<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use App\Models\UnitProfil;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitProfilForm extends Form
{
    // #[Locked]
    public $unitId;

    public $unitMainLogo;

    public $unitSubLogo;

    public $unitMotto;

    public $unitAlamat;

    public $unitNama;

    public function setUnit($id)
    {
        $unit = Unit::find($id);
        $this->unitId = $unit->id;
        $this->unitNama = $unit->nama_unit;
        $unitProfil = UnitProfil::where('unit_id', $this->unitId)->first();
        $this->unitMainLogo = $unitProfil->unit_main_logo ?? '';
        $this->unitSubLogo = $unitProfil->unit_sub_logo ?? '';
        $this->unitAlamat = $unitProfil->unit_alamat ?? '';
        $this->unitMotto = $unitProfil->unit_motto ?? '';
    }

    public function store()
    {
        try {
            $unitProfil = UnitProfil::updateOrCreate(
                [
                    'unit_id' => $this->unitId,
                ],
                [
                    'unit_main_logo' => $this->unitMainLogo,
                    'unit_sub_logo' => $this->unitSubLogo,
                    'unit_alamat' => $this->unitAlamat,
                    'unit_motto' => $this->unitMotto,
                ]
            );
            // dd($this->all());
            if ($unitProfil) {
                return true;
            }
                return false;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
