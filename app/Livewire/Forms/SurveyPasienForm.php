<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Penjamin;
use App\Jobs\GoogleSheetInsert;
use App\Models\KaryawanProfile;
use Illuminate\Support\Facades\Cache;

// use Revolution\Google\Sheets\Facades\Sheets;

class SurveyPasienForm extends Form
{
    public $time;
    public $timeformat;
    public $karyawan;
    public $penjamin;

    public function save()
    {
        try {
            $result = [];
            Carbon::setLocale('id');
            // session()->get('skorRespon');
            // session()->get('namaRespon');
            $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
            $this->timeformat = Carbon::parse($this->time)->translatedFormat('d F Y H:i');
            $this->karyawan = Cache::remember('karyawanProfileSingle', 60, function () {
                return KaryawanProfile::with(['parentUnit', 'parentLayanan'])->find(session()->get('karyawan_id'));
            });
            $this->penjamin = Penjamin::find(session()->get('penjamin_layanan_id'));
            // $result = [
            $result[] = [
                'TGL_SURVEY'            => $this->timeformat,
                'PEGAWAI'               => $this->karyawan->nama_karyawanprofile,
                'UNIT'                  => $this->karyawan->parentUnit->nama_unit,
                'PELAYANAN'             => $this->karyawan->parentLayanan->nama_layanan,
                'NAMA_PASIEN'           => session()->get('namaPasien') ?? '-',
                'TELEPON_PASIEN'        => session()->get('teleponPasien') ?? '-',
                'PENJAMIN'              => $this->penjamin->nama_penjamin ?? 'Invalid',
                'NILAI_SURVEY_KEPUASAN' => session()->get('namaRespon'),
            ];
            // $writeSheet = $this->saveSheet($result);
            $writeSheet = new GoogleSheetInsert($result);
            dispatch($writeSheet);
            // if ($writeSheet > 0) {
            session()->forget([
                'penjamin_layanan_id',
                'shift',
                'skorRespon',
                'namaRespon',
                'namaPasien',
                'teleponPasien'
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
