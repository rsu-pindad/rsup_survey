<?php

namespace App\Livewire;

use App\Livewire\Forms\SurveyForm as Form;
use App\Models\AppSetting;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\PenjaminLayanan;
use App\Models\Unit;
use Livewire\Component;

class Roots extends Component
{

    public Form $form;

    public function save()
    {
        $this->form->validate();
        $store = $this->form->store();
        if ($store != true) {
            return $store;
        }
        return redirect()->route('isi-survey-pelayanan');
    }

    public function render()
    {
        // dd(auth()->user()->getRoleNames());
        $profile = KaryawanProfile::with('parentLayanan')->where('user_id', session()->get('userId'))->first();

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
        $penjaminLayanan = PenjaminLayanan::distinct()->where('layanan_id', $layanan->id)->get('penjamin_id');
        $unit = Unit::with('unitProfil')->find($profile->parentUnit->id);
        $appSetting = AppSetting::get()->last();
        return view('livewire.roots')->with([
            'petugas' => session()->get('userName'),
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
