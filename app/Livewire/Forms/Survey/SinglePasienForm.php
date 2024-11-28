<?php

namespace App\Livewire\Forms\Survey;

use App\Jobs\GoogleSheetInsert;
use App\Models\Layanan;
use App\Models\Respon;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Form;

class SinglePasienForm extends Form
{
    public $responData;
    public $namaPasien  = '';
    public $nomorPasien = '';
    public $penjaminData;
    public $timeFormat;
    public $surveyFormat;

    public function rules()
    {
        return [
            'namaPasien'  => 'required',
            'nomorPasien' => 'required',
            // 'nomorPasien' => 'phone',
        ];
    }

    public function messages()
    {
        return [
            'namaPasien.required'  => 'Mohon isi nama.',
            'nomorPasien.required' => 'Mohon isi nomor handphone.',
            // 'nomorPasien.phone'    => 'Mohon isi nomor handphone dengan benar.',
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
        $resultGoogle = [];
        if ($hasQuestion !== true) {
            $this->validate();
        }
        try {
            $resultGoogle[] = [
                'TGL_SURVEY'            => '=DATE(' . $this->timeFormat . ')',
                'PEGAWAI'               => Auth::user()->parentKaryawanProfile()->value('nama_karyawanprofile'),
                'UNIT'                  => Unit::find(Auth::user()->parentKaryawanProfile()->value('unit_id'))->nama_unit,
                'PELAYANAN'             => Layanan::find(Auth::user()->parentKaryawanProfile()->value('layanan_id'))->nama_layanan,
                'NAMA_PASIEN'           => Str::upper($this->namaPasien) ?? NULL,
                'TELEPON_PASIEN'        => "'" . $this->nomorPasien ?? NULL,
                'PENJAMIN'              => $this->penjaminData,
                'NILAI_SURVEY_KEPUASAN' => Str::upper($this->responData->nama_respon),
                'JAM_SURVEY'            => $this->surveyFormat,
            ];
            $writeSheet = new GoogleSheetInsert($resultGoogle);
            dispatch($writeSheet)->onQueue('GoogleInsert');
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
