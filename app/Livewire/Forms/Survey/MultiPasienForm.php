<?php

namespace App\Livewire\Forms\Survey;

use App\Jobs\Survey\MultiInsertPasien;
use Illuminate\Support\Carbon;
use Livewire\Form;
use Illuminate\Support\Str;

class MultiPasienForm extends Form
{
    public $dataNilai     = [];
    public $stateQuestion = false;
    public $namaPasien    = null;
    public $nomorPasien   = null;

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

    public function setData($dataNilai, $stateQuestion)
    {
        $this->dataNilai     = $dataNilai;
        $this->stateQuestion = $stateQuestion;
    }

    public function store()
    {
        if ($this->stateQuestion) {
            $this->validate();
        }
        try {
            $result = collect($this->dataNilai)->map(function ($item) {
                $item['nama_pelanggan']      = $this->namaPasien ? Str::upper($this->namaPasien) : null;
                $item['handphone_pelanggan'] = $this->nomorPasien ? '0' . $this->nomorPasien : null;

                return $item;
            });
            $finalResult = $result->toArray();

            return MultiInsertPasien::dispatchSync($finalResult);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function resetForm()
    {
        $this->reset();
    }
}
