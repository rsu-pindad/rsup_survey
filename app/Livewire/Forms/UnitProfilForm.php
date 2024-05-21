<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use App\Models\UnitProfil;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class UnitProfilForm extends Form
{
    use WithFileUploads;

    #[Locked]
    public $unitId;

    // #[Reactive]
    #[Validate('required')]
    public $unitMainLogo;

    // #[Reactive]
    #[Validate('required')]
    public $unitSubLogo;

    // #[Reactive]
    #[Validate('required')]
    public $unitMainLogoOld;

    // #[Reactive]
    #[Validate('required')]
    public $unitSubLogoOld;

    #[Validate('required')]
    public $unitMotto;

    #[Validate('required')]
    public $unitAlamat;

    #[Validate('required')]
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
            $mainRandomName = Str::random(20);
            $subRandomName = Str::random(20);
            $mainName = $mainRandomName . '.' . $this->unitMainLogo[0]['extension'];
            $subName = $subRandomName . '.' . $this->unitSubLogo[0]['extension'];
            // dd($mainName, $subName);

            // Simpan photo pada folder public photos
            // Storage::disk('public_upload')->putFileAs('photos', new File($this->unitMainLogo[0]['path']), $mainName);
            // Storage::disk('public_upload')->putFileAs('photos', new File($this->unitSubLogo[0]['path']), $subName);

            Storage::putFileAs('public/basset/photos', new File($this->unitMainLogo[0]['path']), $mainName);
            Storage::putFileAs('public/basset/photos', new File($this->unitSubLogo[0]['path']), $subName);

            // /home/u5336745/pmu-laravel10-livewire-3-survey/public
            $pathSharedHosting = '/home/u5336745/pmu-laravel10-livewire-3-survey/public/photos/';
            if (env('APP_ENV') != 'local') {
                $pathMain = 'public/basset/photos/' . $mainName;
                $pathSub = 'public/basset/photos/' . $subName;
                Storage::move($pathMain, $pathSharedHosting . $mainName);
                Storage::move($pathSub, $pathSharedHosting . $subName);
            }

            // $main = Storage::move($this->unitSubLogo[0]['path'], public_path().'photos'.$mainName);
            // File:deleteDirectory('tmp/');
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
            // dd($unitProfil);
            if (env('APP_ENV') == 'local') {
                if ($this->unitMainLogoOld != '' || $this->unitMainLogoOld != null) {
                    // $pathMain = public_path().'photos/'.$mainName;
                    // $pathMain = '/photos/' . $this->unitMainLogoOld;
                    // Storage::disk('public_upload')->delete($pathMain);
                    $pathMain = 'public/basset/photos/' . $this->unitMainLogoOld;
                    Storage::delete($pathMain);
                }
                if ($this->unitSubLogoOld != '' || $this->unitSubLogoOld != null) {
                    // $pathSub = public_path().'photos/'.$subName;
                    // $pathSub = '/photos/' . $this->unitSubLogoOld;
                    // Storage::disk('public_upload')->delete($pathSub);
                    $pathSub = 'public/basset/photos/' . $this->unitSubLogoOld;
                    Storage::delete($pathSub);
                }
            }else{
                if ($this->unitMainLogoOld != '' || $this->unitMainLogoOld != null) {
                    // $pathMain = public_path().'photos/'.$mainName;
                    // $pathMain = '/photos/' . $this->unitMainLogoOld;
                    // Storage::disk('public_upload')->delete($pathMain);
                    $pathMain = $pathSharedHosting . $this->unitMainLogoOld;
                    Storage::delete($pathMain);
                }
                if ($this->unitSubLogoOld != '' || $this->unitSubLogoOld != null) {
                    // $pathSub = public_path().'photos/'.$subName;
                    // $pathSub = '/photos/' . $this->unitSubLogoOld;
                    // Storage::disk('public_upload')->delete($pathSub);
                    $pathSub = $pathSharedHosting . $this->unitSubLogoOld;
                    Storage::delete($pathSub);
                }
            }
            // Storage::deleteDirectory('tmp');
            // dd($delMain,$delSub);

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
