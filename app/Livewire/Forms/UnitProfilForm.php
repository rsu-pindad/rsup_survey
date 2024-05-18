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
            $mainName = bcrypt($this->unitMainLogo[0]['name']).".".$this->unitMainLogo[0]['extension'];
            $subName = bcrypt($this->unitSubLogo[0]['name']).".".$this->unitSubLogo[0]['extension'];
            // dd($mainName);

            $main = Storage::disk('public_upload')->putFileAs('/', new File($this->unitMainLogo[0]['path']), $mainName);
            $sub = Storage::disk('public_upload')->putFileAs('/', new File($this->unitSubLogo[0]['path']), $subName);
            // $main = Storage::move($this->unitSubLogo[0]['path'], public_path().'/photos/'.$mainName);
            // File:deleteDirectory('tmp/');
            // dd($main);
            if($this->unitMainLogoOld != '' || $this->unitMainLogoOld != null){
                Storage::disk('public_upload')->delete('/',$this->unitMainLogoOld);
            }
            if($this->unitSubLogoOld != '' || $this->unitSubLogoOld != null){
                Storage::disk('public_upload')->delete('/',$this->unitSubLogoOld);
            }
            $unitProfil = UnitProfil::updateOrCreate(
                [
                    'unit_id' => $this->unitId,
                ],
                [
                    'unit_main_logo' => $mainName ?? $this->unitMainLogoOld,
                    'unit_sub_logo' => $subName ?? $this->unitSubLogoOld,
                    'unit_alamat' => $this->unitAlamat,
                    'unit_motto' => $this->unitMotto,
                ]
            );
            // Storage::deleteDirectory('tmp');
            // return $unitProfil;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
