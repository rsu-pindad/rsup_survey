<?php

namespace App\Livewire\Forms;

use App\Models\KaryawanProfile;
use App\Models\Penjamin;
use Carbon\Carbon;
use Livewire\Form;
use Revolution\Google\Sheets\Facades\Sheets;

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
            $this->namaPasien = session()->get('namaPasien') ?? '';
            $this->teleponPasien = session()->get('teleponPasien') ?? '';
            $this->karyawan = KaryawanProfile::with(['parentUnit', 'parentLayanan'])->find(session()->get('karyawan_id'));
            $this->penjamin = Penjamin::find(session()->get('penjamin_layanan_id'));
            $result = [];
            foreach (session()->get('jawabanPasien') as $keys => $items) {
                $result[] = [
                    'TGL_SURVEY' => $this->timeformat,
                    'PEGAWAI' => $this->karyawan->nama_karyawanprofile,
                    'UNIT' => $this->karyawan->parentUnit->nama_unit,
                    'PELAYANAN' => $items['namaLayanan'],
                    'NAMA_PASIEN' => $items['hasQuestion'] === true ? $this->namaPasien : '',
                    'TELEPON_PASIEN' => $items['hasQuestion'] === true ? $this->teleponPasien : '',
                    'PENJAMIN' => $this->penjamin->nama_penjamin,
                    'NILAI_SURVEY_KEPUASAN' => $items['namaRespon'],
                ];
            }
            return $this->saveSheet($result);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function saveSheet($items = [])
    {
        try {
            $sheets = Sheets::spreadsheet(env('SPREADSHEET_ID', ''))
                ->sheet(env('SPREADSHEET_NAME', ''))
                ->append($items);
            return $sheets->updates->updatedRows;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
