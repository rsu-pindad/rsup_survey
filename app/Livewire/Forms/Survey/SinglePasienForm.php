<?php

namespace App\Livewire\Forms\Survey;

use App\Jobs\Survey\SingleInsertPasien;
// use App\Jobs\GoogleSheetInsert;
use App\Models\{Layanan, Respon, Unit};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\{Carbon, Str};
use Livewire\Form;

class SinglePasienForm extends Form
{
    public $responData;
    public $namaPasien  = '';
    public $nomorPasien = '';
    public $penjaminData;
    public $timeFormat;
    public $surveyFormat;
    public $shift;

    public function rules()
    {
        return [
            'namaPasien'  => 'required|min:3|max:50',
            'nomorPasien' => 'required|digits_between:5,10',
        ];
    }

    public function messages()
    {
        return [
            'namaPasien.required'        => 'Mohon isi nama.',
            'namaPasien.min'             => 'minimal 3 huruf',
            'namaPasien.max'             => 'maksimal 50 huruf',
            'nomorPasien.required'       => 'Mohon isi nomor handphone.',
            'nomorPasien.digits_between' => 'Mohon isi nomor handphone dengan benar.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'namaPasien'  => 'string',
            'nomorPasien' => 'phone:id,ID',
        ];
    }

    public function boot()
    {
        $this->timeFormat   = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y;m;d');
        $this->surveyFormat = Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i');
    }

    public function setRespon($postId)
    {
        $this->responData = Respon::find($postId);
    }

    public function setPenjamin($penjamin)
    {
        $this->penjaminData = $penjamin;
    }

    public function store($hasQuestion)
    {
        $resultData = [];
        if ($hasQuestion !== true) {
            $this->validate();
        }
        try {
            $shiftHours = now()->hour;
            if ($shiftHours >= 7 && $shiftHours <= 15) {
                $this->shift = 'pagi';
            } elseif ($shiftHours >= 16 && $shiftHours <= 23) {
                $this->shift = 'siang';
            } else {
                $this->shift = 'malam';
            }
            $resultData = [
                'karyawan_id'         => intval(Auth::user()->parentKaryawanProfile()->value('id')),
                'penjamin_id'         => intval($this->penjaminData),
                'layanan_id'          => intval(Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->id),
                'nama_pelanggan'      => $this->namaPasien ? Str::upper($this->namaPasien) : null,
                'handphone_pelanggan' => $this->nomorPasien ? '0' . $this->nomorPasien : null,
                'shift'               => $this->shift,
                'nilai_skor'          => $this->responData->nama_respon,
                'survey_masuk'        => Carbon::now()->format('Y-m-d H:i:s')
            ];

            return SingleInsertPasien::dispatchSync($resultData);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function resetForm()
    {
        $this->reset();
    }

    // public function store($hasQuestion)
    // {
    //     $resultGoogle = [];
    //     if ($hasQuestion !== true) {
    //         $this->validate();
    //     }
    //     try {
    //         $resultGoogle[] = [
    //             'TGL_SURVEY'            => '=DATE(' . $this->timeFormat . ')',
    //             'PEGAWAI'               => Auth::user()->parentKaryawanProfile()->value('nama_karyawanprofile'),
    //             'UNIT'                  => Unit::find(Auth::user()->parentKaryawanProfile()->value('unit_id'))->nama_unit,
    //             'PELAYANAN'             => Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->nama_layanan,
    //             'NAMA_PASIEN'           => Str::upper($this->namaPasien) ?? NULL,
    //             'TELEPON_PASIEN'        => "'" . $this->nomorPasien ?? NULL,
    //             'PENJAMIN'              => $this->penjaminData,
    //             'NILAI_SURVEY_KEPUASAN' => Str::upper($this->responData->nama_respon),
    //             'JAM_SURVEY'            => $this->surveyFormat,
    //         ];
    //         $writeSheet = new GoogleSheetInsert($resultGoogle);
    //         dispatch($writeSheet)->onQueue('GoogleInsert');
    //         $this->reset();

    //         return true;
    //     } catch (\Throwable $th) {
    //         return $th->getMessage();
    //     }
    // }
}
