<?php

namespace App\Livewire;

use App\Livewire\Forms\HomePenjaminForm as Form;
use App\Models\AppSetting;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\PenjaminLayanan;
use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Component;

// use Intervention\Image\Laravel\Facades\Image;

class Home extends Component
{
    public Form $form;

    public function boot()
    {
        if (!auth()->user()->hasRole('employee')) {
            return redirect()->intended('/lihat');
        }
    }

    public function save()
    {
        $this->form->validate();
        return $this->form->store();
    }

    #[Layout('components.layouts.beranda')]
    public function render()
    {
        $profile = KaryawanProfile::where('user_id', session()->get('userId'))->first();
        if ($profile == null) {
            return <<<HTML
                <div>
                    <p>Profile tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
        }
        $layanan = Layanan::findOrFail($profile->layanan_id);
        if ($layanan == null) {
            return <<<HTML
                <div>
                    <p>Layanan tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
        }
        $penjaminLayanan = PenjaminLayanan::distinct()
            ->where('layanan_id', $layanan->id)
            ->get('penjamin_id');
        $unit = Unit::with('unitProfil')->find($profile->parentUnit->id);
        $appSetting = AppSetting::get()->last();
        session()->put('multiPenilaian', $profile->parentUnit->multi_penilaian);
        session()->put('userUnitId', $profile->parentUnit->id);
        session()->put('userLayananId', $profile->parentLayanan->id);
        session()->put('userLayananMulti', $profile->parentLayanan->multi_layanan);
        return view('livewire.home')->with([
            'petugas' => $profile->nama_karyawanprofile,
            'layanan' => $profile->parentLayanan->nama_layanan,
            'unitNama' => $profile->parentUnit->nama_unit,
            'unitAlamat' => $unit->unitProfil->unit_alamat ?? $appSetting->initial_alamat_text,
            'penjamin' => $penjaminLayanan,
            'mainLogo' => $unit->unitProfil->unit_main_logo ?? 'settings/' . $appSetting->initial_body_logo,
            'subLogo' => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
            'unitMoto' => $unit->unitProfil->unit_motto ?? $appSetting->initial_moto_text,
        ]);
    }
}
