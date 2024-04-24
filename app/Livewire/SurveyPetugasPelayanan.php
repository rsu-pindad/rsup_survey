<?php

namespace App\Livewire;

use App\Models\KaryawanProfile;
use App\Models\LayananRespon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\SurveyPelanggan;

class SurveyPetugasPelayanan extends Component
{
    // #[Validate('required')]
    // public $responSkor;

    public function save($responSkor) {
        // $this->validate();
        // dd($responSkor);
        try {
            $store = new SurveyPelanggan;
            $store->karyawan_id = session()->get('karyawan_id');
            $store->penjamin_layanan_id = session()->get('penjamin_layanan_id');
            $store->nama_pelanggan = session()->get('nama_pelanggan');
            $store->handphone_pelanggan = session()->get('handphone_pelanggan');
            $store->shift = 1;
            $store->nilai_skor = $responSkor;
            $store->save();
            return redirect()->route('roots-dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        // dd(session()->get('nama_pelanggan'));
        $layananKaryawan = KaryawanProfile::where('user_id', Auth::user()->id)->first();
        // dd($layananKaryawan->toArray());
        $repons = LayananRespon::where('layanan_id', $layananKaryawan->layanan_id)->get();
        // dd($repons->toArray());
        return view('livewire.survey-petugas-pelayanan')->with([
            'petugas' => Auth::user()->name,
            'respons' => $repons,
            'layanan' => $layananKaryawan->parentLayanan->nama_layanan,
        ]);
    }
}
