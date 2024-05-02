<?php

namespace App\Livewire;

use App\Livewire\Forms\SurveyForm as Form;
use App\Models\KaryawanProfile;
use App\Models\PenjaminLayanan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Roots extends Component
{
    use LivewireAlert;

    public Form $form;

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return $this->flash('info', 'selamat tinggal', [
            'position' => 'center',
        ], route('login'));
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store == true) {
            return redirect()->route('isi-survey-pelayanan');
        }
    }

    public function render()
    {
        $profile = KaryawanProfile::where('user_id', session()->get('userId'))->first();
        $layanan = Layanan::where('id', $profile->layanan_id)->first();
        
        if ($profile) {
            if($layanan != null){
            $penjaminLayanan = PenjaminLayanan::distinct()->where('layanan_id', $layanan->id)->get('penjamin_id');
                return view('livewire.roots')->with([
                    'petugas' => session()->get('userName'),
                    'penjamin' => $penjaminLayanan,
                ]);
            }else{
                return <<<HTML
                <div>
                    <p>Layanan tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
            }
        } else {
            return <<<HTML
                <div>
                    <p>Profile tidak ditemukan... hubungi sdm</p>
                    <a href="/logout">Keluar</a>
                </div>
                HTML;
        }
    }
}
