<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\KaryawanProfile;
use App\Models\Penjamin;
use Carbon\Carbon;
use Revolution\Google\Sheets\Facades\Sheets;

class SurveyPasienForm extends Form
{

    public $namaPasien = '';

    public $teleponPasien = '';

    public $namaRespon = '';

    public $skorRespon = '';

    public $time = '';

    public function mount()
    {
        Carbon::setLocale('id');
        $time = Carbon::now()->setTimezone('Asia/Jakarta');
        $this->time = $time;
    }

    public function save()
    {
        // dd($this->namaPasien);
        session()->get('skorRespon');
        session()->get('namaRespon');
        try {
            $writeSheet = $this->saveSheet();
            if ($writeSheet == 1) {
                session()->forget([
                    'penjamin_layanan_id',
                    'shift',
                    'skorRespon',
                    'namaRespon'
                ]);
            }
            return $writeSheet;
            // }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function saveSheet()
    {
        // session()->get('skorRespon'), session()->get('namaRespon')
        try {
            $karyawan = KaryawanProfile::with(['parentUnit', 'parentLayanan'])
                ->find(session()->get('karyawan_id'));
            $penjamin = Penjamin::findOrFail(session()->get('penjamin_layanan_id'));
            $timeformat = Carbon::parse($this->time)->translatedFormat('d F Y H:i');
            $sheets = Sheets::spreadsheet(env('SPREADSHEET_ID', ''))
                ->sheet(env('SPREADSHEET_NAME', ''))
                ->append(
                    [
                        [
                            'TGL_SURVEY' => $timeformat,
                            'PEGAWAI' => $karyawan->nama_karyawanprofile,
                            'UNIT' => $karyawan->parentUnit->nama_unit,
                            'PELAYANAN' => $karyawan->parentLayanan->nama_layanan,
                            'NAMA_PASIEN' => session()->get('nama_pelanggan') ?? '-',
                            'PENJAMIN' => $penjamin->nama_penjamin,
                            'NILAI_SURVEY_KEPUASAN' => session()->get('namaRespon'),
                        ]
                    ]
                );
            return $sheets->updates->updatedRows;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
