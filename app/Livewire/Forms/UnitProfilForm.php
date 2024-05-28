<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use App\Models\UnitProfil;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class UnitProfilForm extends Form
{
    use WithFileUploads;

    public ?UnitProfil $unitProfile;

    #[Locked]
    public $unitId;

    #[Validate('required', message: 'mohon unggah logo utama', onUpdate: false)]
    public $unitMainLogo;

    #[Validate('required', message: 'mohon unggah logo kedua', onUpdate: false)]
    public $unitSubLogo;

    // #[Validate('required', onUpdate: false)]
    public $unitMainLogoOld;

    // #[Validate('required', onUpdate: false)]
    public $unitSubLogoOld;

    #[Validate('required', message: 'mohon isi motto', onUpdate: false)]
    public $unitMotto;

    #[Validate('required', message: 'mohon isi alamat', onUpdate: false)]
    public $unitAlamat;

    #[Validate('required', onUpdate: false)]
    public $unitNama;

    public function setUnit($id)
    {
        $unit = Unit::findOrFail($id);
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
        try {
            $this->validate();
            $mainRandomName = Str::random(20);
            $subRandomName = Str::random(20);
            $mainName = $mainRandomName . '.' . $this->unitMainLogo[0]['extension'];
            $subName = $subRandomName . '.' . $this->unitSubLogo[0]['extension'];
            // Simpan photo pada folder public photos
            if (env('APP_ENV') == 'local') {
                Storage::putFileAs('public/basset/photos', new File($this->unitMainLogo[0]['path']), $mainName);
                Storage::putFileAs('public/basset/photos', new File($this->unitSubLogo[0]['path']), $subName);
            } else {
                Storage::disk('public_upload')->putFileAs('photos', new File($this->unitMainLogo[0]['path']), $mainName);
                Storage::disk('public_upload')->putFileAs('photos', new File($this->unitSubLogo[0]['path']), $subName);
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
            if (env('APP_ENV') == 'local') {
                if ($this->unitMainLogoOld != '' || $this->unitMainLogoOld != null) {
                    $pathMain = 'public/basset/photos/' . $this->unitMainLogoOld;
                    Storage::delete($pathMain);
                }
                if ($this->unitSubLogoOld != '' || $this->unitSubLogoOld != null) {
                    $pathSub = 'public/basset/photos/' . $this->unitSubLogoOld;
                    Storage::delete($pathSub);
                }
            } else {
                if ($this->unitMainLogoOld != '' || $this->unitMainLogoOld != null) {
                    $pathMain = '/photos/' . $this->unitMainLogoOld;
                    Storage::disk('public_upload')->delete($pathMain);
                }
                if ($this->unitSubLogoOld != '' || $this->unitSubLogoOld != null) {
                    $pathSub = '/photos/' . $this->unitSubLogoOld;
                    Storage::disk('public_upload')->delete($pathSub);
                }
            }
            // Storage::deleteDirectory('tmp');
            // Delete Files pada folder tmp;
            Storage::delete('/tmp/' . $this->unitMainLogo[0]['tmpFilename']);
            Storage::delete('/tmp/' . $this->unitSubLogo[0]['tmpFilename']);
            // File::delete($this->unitMainLogo[0]['tmpFilename']);
            // File::delete($this->unitSubLogo[0]['tmpFilename']);
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
