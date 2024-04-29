<?php

namespace App\Livewire;

use App\Models\KaryawanProfile;
use App\Models\LayananRespon;
use App\Models\Respon;
use App\Models\SurveyPelanggan;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SurveyPetugasPelayanan extends Component
{
    use LivewireAlert;

    #[Validate('required')]
    public $skor;

    #[Validate('required')]
    public $nama_skor;

    public function getListeners()
    {
        return [
            'confirmed',
            'cancelled'
        ];
    }

    public function cancelled()
    {
        $this->skor = '';
        $this->nama_skor = '';
    }

    public function confirmed()
    {
        try {
            $this->validate();
            $store = $this->save($this->skor);
            if ($store == true) {
                return $this->flash('success', 'Berhasil Menilai Layanan', [
                    'position' => 'center',
                    'toast' => true,
                ], '/');
            }
        } catch (\Throwable $th) {
            return $this->flash('warning', 'Gagal Menilai Layanan', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessages(),
            ]);
        }
    }

    public function preSave($skor)
    {
        $skor = Respon::where('id', $skor)->first();
        $this->nama_skor = $skor->nama_respon;
        $this->skor = $skor->skor_respon;
        $this->confirm('Beri nilai ' . $this->nama_skor . ' ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Nilai',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function save($responSkor)
    {
        try {
            $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
            $store = new SurveyPelanggan;
            $store->karyawan_id = session()->get('karyawan_id');
            $store->penjamin_layanan_id = session()->get('penjamin_layanan_id');
            $store->nama_pelanggan = session()->get('nama_pelanggan');
            $store->handphone_pelanggan = session()->get('handphone_pelanggan');
            $store->shift = 1;
            $store->nilai_skor = $responSkor;
            $store->created_at = $time;
            $store->updated_at = $time;
            $store->save();
            if ($store) {
                return true;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function render()
    {
        $layananKaryawan = KaryawanProfile::where('user_id', Auth::user()->id)->first();
        $repons = LayananRespon::distinct()->where('layanan_id', $layananKaryawan->layanan_id)->get('respon_id');
        return view('livewire.survey-petugas-pelayanan')->with([
            'petugas' => Auth::user()->name,
            'respons' => $repons,
            'layanan' => $layananKaryawan->parentLayanan->nama_layanan,
        ]);
    }
}
