<?php

namespace App\Livewire;

use App\Models\KaryawanProfile;
use App\Models\LayananRespon;
use App\Models\Respon;
use App\Models\SurveyPelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Revolution\Google\Sheets\Facades\Sheets;

class SurveyPetugasPelayanan extends Component
{
    use LivewireAlert;

    #[Validate('required')]
    public $skor_respon;

    #[Validate('required')]
    public $nama_respon;

    public function getListeners()
    {
        return [
            'confirmed',
            'cancelled'
        ];
    }

    public function cancelled()
    {
        $this->skor_respon = '';
        $this->nama_respon = '';
    }

    public function confirmed()
    {
        try {
            $this->validate();
            $store = $this->save($this->skor_respon,$this->nama_respon);
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
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function preSave($skor)
    {
        $skor = Respon::where('id', $skor)->first();
        $this->nama_respon = $skor->nama_respon;
        $this->skor_respon = $skor->skor_respon;
        $this->confirm('Beri nilai ' . $this->nama_respon . ' ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Nilai',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function save($responSkor, $responNama)
    {
        try {
            \Carbon\Carbon::setLocale('id');
            // $time = \Carbon\Carbon::now()->shiftTimezone('Asia/Jakarta');
            $time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
            $store = new SurveyPelanggan;
            $store->karyawan_id = session()->get('karyawan_id');
            $store->penjamin_layanan_id = session()->get('penjamin_layanan_id');
            $store->nama_pelanggan = session()->get('nama_pelanggan');
            $store->handphone_pelanggan = session()->get('handphone_pelanggan');
            $store->shift = 1;
            $store->nilai_skor = $responSkor;
            // $store->nilai_skor = 1;
            $store->created_at = $time;
            $store->updated_at = $time;
            $store->save();
            if ($store) {
                $this->saveSheet($responSkor, $responNama, $time);
                // $this->sendWhatsapp();
                $request->session()->forget([
                    'penjamin_layanan_id', 'nama_pelanggan', 'handphone_pelanggan'
                ]);
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function saveSheet($responSkor, $responNama, $time)
    {
        try {
            \Carbon\Carbon::setLocale('id');
            $karyawan = \App\Models\KaryawanProfile::with(['parentUnit', 'parentLayanan'])
                ->where('id', session()->get('karyawan_id'))
                ->first();
            $penjamin = \App\Models\PenjaminLayanan::with(['parentPenjamin'])
                ->where('penjamin_id', session()->get('penjamin_layanan_id'))
                ->first();
            $timeformat = \Carbon\Carbon::parse($time)->translatedFormat('d F Y H:i');
            $sheets = Sheets::spreadsheet('1FEz14MGqe8n5UQ4voiy21nmWxYSub_eiCjuh3LLH5r0')
                ->sheet('Sheet1')
                ->append(
                    [
                        [
                            'TGL_SURVEY' => $timeformat,
                            'PEGAWAI' => $karyawan->nama_karyawanprofile,
                            'UNIT' => $karyawan->parentUnit->nama_unit,
                            'PELAYANAN' => $karyawan->parentLayanan->nama_layanan,
                            'NAMA_PASIEN' => session()->get('nama_pelanggan'),
                            'PENJAMIN' => $penjamin->parentPenjamin->nama_penjamin,
                            'NILAI_SURVEY_KEPUASAN' => $responNama,
                        ]
                    ]
                );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function sendWhatsapp()
    {
        try {
            $curl = curl_init();

            $msg = 'Terimakasih ' . session()->get('nama_pelanggan') . ', Telah mengikuti survey';

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => session()->get('handphone_pelanggan'),
                    'message' => $msg,
                    'countryCode' => '62',  // optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . env('FONNTE_TOKEN')  // change TOKEN to your actual token
                ),
            ));

            sleep(3);

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);

            if (isset($error_msg)) {
                echo $error_msg;
            }
            return $response;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function render()
    {
        $layananKaryawan = KaryawanProfile::where('user_id', Auth::user()->id)->first();

        $respon =
            LayananRespon::distinct()
                ->where('layanan_id', $layananKaryawan->layanan_id)
                ->with([
                    'parentLayanan' => function ($query) use ($layananKaryawan) {
                        $query->find($layananKaryawan->layanan_id);
                    },
                    'parentRespon' => function ($query) {
                        $query->orderBy('urutan_respon', 'ASC');
                    },
                ])
                ->orderBy('layanan_id', 'DESC')
                ->get();
        // dd($respon);
        // $response = $respon->pluck('parentRespon')->toArray();
        $response = (object)$respon->pluck('parentRespon');

        $collectionRespon = collect((object)$response);
        $sorted = $collectionRespon->sortBy('urutan_respon');
        $sorted->values()->all();
        // dd($sorted);
        return view('livewire.survey-petugas-pelayanan')->with([
            'petugas' => Auth::user()->name,
            'respons' => $sorted,
            'layanan' => $layananKaryawan->parentLayanan->nama_layanan,
        ]);
    }
}
