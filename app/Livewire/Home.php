<?php

namespace App\Livewire;

use App\Livewire\Forms\HomePenjaminForm as Form;
use App\Models\AppSetting;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\PenjaminLayanan;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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
    #[Title('Beranda')]
    public function render()
    {
        $profile = KaryawanProfile::with(['parentUnit', 'parentLayanan'])->where('user_id', Auth::id())->first();
        if ($profile == null) {
            return <<<HTML
                <div>
                    <p>Profile tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
        }
        $layanan = Layanan::find($profile->layanan_id);
        if ($layanan == null) {
            return <<<HTML
                <div>
                    <p>Layanan tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
        }
        // $penjaminLayanan = Cache::remember('penjaminLayanan', 60, function () use ($layanan) {
        //     return PenjaminLayanan::distinct()
        //                ->where('layanan_id', $layanan->id)
        //                ->get('penjamin_id');
        // });
        $unit = Cache::remember('unitProfile', 120, function () use ($profile) {
            return Unit::with('unitProfil')->find($profile->parentUnit->id);
        });
        $appSetting = Cache::remember('appSetting', 120, function () {
            return AppSetting::get()->last();
        });
        session()->put('multiPenilaian', $profile->parentUnit->multi_penilaian);
        session()->put('userUnitId', $profile->parentUnit->id);
        session()->put('userLayananId', $profile->parentLayanan->id);
        session()->put('userLayananNama', $profile->parentLayanan->nama_layanan);
        session()->put('userLayananMulti', $profile->parentLayanan->multi_layanan);

        return view('livewire.home')->with([
            'petugas'    => $profile->nama_karyawanprofile,
            'layanan'    => $profile->parentLayanan->nama_layanan,
            'unitNama'   => $profile->parentUnit->nama_unit,
            'unitAlamat' => $unit->unitProfil->unit_alamat ?? $appSetting->initial_alamat_text,
            'penjamin'   => PenjaminLayanan::where('layanan_id', $layanan->id)->get('penjamin_id'),
            'mainLogo'   => $unit->unitProfil->unit_main_logo ?? 'settings/' . $appSetting->initial_body_logo,
            'subLogo'    => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
            'unitMoto'   => $unit->unitProfil->unit_motto ?? $appSetting->initial_moto_text,
        ]);
    }
}
