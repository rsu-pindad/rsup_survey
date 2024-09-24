<?php

namespace App\Livewire\Forms;

use App\Jobs\GoogleSheetInsert;
use App\Jobs\InsertSurveyPelangganSingle;
use App\Models\KaryawanProfile;
use App\Models\Penjamin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Form;

// use Revolution\Google\Sheets\Facades\Sheets;

class SurveyPasienForm extends Form
{
    public $time;
    public $timeformat;
    public $timeformatDb;
    public $karyawan;
    public $penjamin;

    public function save()
    {
        try {
            $result    = [];
            $resultsDb = [];
            $shift     = '';
            Carbon::setLocale('id');
            // session()->get('skorRespon');
            // session()->get('namaRespon');
            $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
            $this->timeformat = Carbon::parse($this->time)->translatedFormat('d F Y H:i');
            $this->timeformatDb = Carbon::parse($this->time)->translatedFormat('Y-m-d H:i:s');
            $this->karyawan = Cache::remember('karyawanProfileSingle', 60, function () {
                return KaryawanProfile::with(['parentUnit', 'parentLayanan'])->find(session()->get('karyawan_id'));
            });
            $this->penjamin = Penjamin::find(session()->get('penjamin_layanan_id'));
            // $result = [
            $shiftHours = now()->hour;
            if (($shiftHours >= 7) && ($shiftHours <= 15)) {
                $shift = 'pagi';
            } else if (($shiftHours >= 16) && ($shiftHours <= 23)) {
                $shift = 'siang';
            } else {
                $shift = 'malam';
            }
            $result[] = [
                'TGL_SURVEY'            => $this->timeformat,
                'PEGAWAI'               => $this->karyawan->nama_karyawanprofile,
                'UNIT'                  => $this->karyawan->parentUnit->nama_unit,
                'PELAYANAN'             => session()->get('userLayananNama') ?? '-',
                'NAMA_PASIEN'           => session()->get('namaPasien') ?? '-',
                'TELEPON_PASIEN'        => session()->get('teleponPasien') ?? '-',
                'PENJAMIN'              => $this->penjamin->nama_penjamin ?? 'Invalid',
                'NILAI_SURVEY_KEPUASAN' => session()->get('namaRespon'),
            ];
            // ];

            // $writeSheet = $this->saveSheet($result);

            $writeSheet = new GoogleSheetInsert($result);
            dispatch($writeSheet)->onQueue('SingleGoogleInsert');

            $resultsDb = [
                'karyawan_id'         => intval($this->karyawan->id),
                'penjamin_id'         => intval($this->penjamin->id),
                'layanan_id'          => intval($this->karyawan->parentLayanan->id),
                'nama_pelanggan'      => session()->get('namaPasien') ?? null,
                'handphone_pelanggan' => session()->get('teleponPasien') ?? null,
                'shift'               => $shift,
                'nilai_skor'          => session()->get('namaRespon'),
                'survey_masuk'        => $this->timeformatDb
            ];
            // dd($resultsDb);

            $insertDb = new InsertSurveyPelangganSingle($resultsDb);
            dispatch($insertDb)->onQueue('SingleDbInsert');

            // if ($writeSheet > 0) {
            session()->forget([
                'penjamin_layanan_id',
                'shift',
                'skorRespon',
                'namaRespon',
                'namaPasien',
                'teleponPasien',
                'shift'
            ]);
            // }

            // return $writeSheet;
            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // private function saveSheet($items = [])
    // {
    //     try {
    //         $sheets = Sheets::spreadsheet(config('google.config.sheet_id'))
    //                       ->sheet(config('google.config.sheet_name'))
    //                       ->append([$items]);

    //         return $sheets->updates->updatedRows;
    //     } catch (\Throwable $th) {
    //         return $th->getMessage();
    //     }
    // }
}
