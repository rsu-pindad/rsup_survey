<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use App\Models\Penjamin;
use Carbon\Carbon;
use Livewire\Form;
// use Revolution\Google\Sheets\Facades\Sheets;
use App\Jobs\GoogleSheetInsertMulti;
use Illuminate\Support\Facades\Cache;
use App\Jobs\InsertSurveyPelangganMulti;

class SurveyPasienMultiForm extends Form
{
    public $time;
    public $timeformat;
    public $namaPasien;
    public $teleponPasien;
    public $karyawan;
    public $penjamin;

    public function save()
    {
        try {
            Carbon::setLocale('id');
            $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
            $this->timeformat = Carbon::parse($this->time)->translatedFormat('d F Y H:i');
            $this->timeformatDb = Carbon::parse($this->time)->translatedFormat('Y-m-d H:i:s');
            $this->namaPasien = session()->get('namaPasien') ?? '';
            $this->teleponPasien = session()->get('teleponPasien') ?? '';
            $this->karyawan = Cache::remember('karyawanProfileMulti', 120, function () {
                return KaryawanProfile::with(['parentUnit', 'parentLayanan'])->find(session()->get('karyawan_id'));
            });
            $this->penjamin = Penjamin::find(session()->get('penjamin_layanan_id'));
            $shiftHours = now()->hour;
            $shift = '';
            if (($shiftHours >= 7) && ($shiftHours <= 15)) {
                $shift = 'pagi';
            } else if (($shiftHours >= 16) && ($shiftHours <= 23)) {
                $shift = 'siang';
            } else {
                $shift = 'malam';
            }
            $result         = [];
            $resultsDb      = [];
            foreach (session()->get('jawabanPasien') as $keys => $items) {
                $result[] = [
                    'TGL_SURVEY'            => $this->timeformat,
                    'PEGAWAI'               => $this->karyawan->nama_karyawanprofile,
                    'UNIT'                  => $this->karyawan->parentUnit->nama_unit,
                    'PELAYANAN'             => $items['namaLayanan'],
                    'NAMA_PASIEN'           => $items['hasQuestion'] === true ? $this->namaPasien : session()->get('namaPasien'),
                    'TELEPON_PASIEN'        => $items['hasQuestion'] === true ? $this->teleponPasien : session()->get('teleponPasien'),
                    'PENJAMIN'              => $this->penjamin->nama_penjamin ?? 'Invalid',
                    'NILAI_SURVEY_KEPUASAN' => $items['namaRespon'],
                ];
                $resultsDb = [
                    'karyawan_id'         => intval($this->karyawan->id),
                    'penjamin_id'         => intval($this->penjamin->id),
                    'layanan_id'          => intval($items['idLayanan']),
                    'nama_pelanggan'      => $items['hasQuestion'] === true ? $this->namaPasien : null,
                    'handphone_pelanggan' => $items['hasQuestion'] === true ? $this->teleponPasien : null,
                    'shift'               => $shift,
                    'nilai_skor'          => $items['namaRespon'],
                    'survey_masuk'        => $this->timeformatDb
                ];
                
                $insertDb = new InsertSurveyPelangganMulti($resultsDb);
                dispatch($insertDb)->onQueue('MultiDbInsert');
            }
            
            $sheets = new GoogleSheetInsertMulti($result);
            dispatch($sheets)->onQueue('MultiGoogleInsert');
    
            // dd($resultsDb);

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // private function saveSheet($items = [])
    // {
    //     try {
    //         $sheets = Sheets::spreadsheet(config('google.config.sheet_id'))
    //             ->sheet(config('google.config.sheet_name'))
    //             ->append($items);
    //         return $sheets->updates->updatedRows;
    //     } catch (\Throwable $th) {
    //         return $th->getMessage();
    //     }
    // }
}
