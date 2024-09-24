<?php

namespace App\Livewire\Forms;

use App\Models\Respon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class ResponForm extends Form
{
    public ?Respon $respon;

    #[Locked]
    public $id;

    public $namaRespon     = '';
    public $iconRespon     = '';
    public $skorRespon     = '';
    public $urutanRespon   = '';
    public $tagWarnaRespon = '';
    public $hasQuestion    = false;
    public $respons;

    // public function boot()
    // {
    //     $this->respon = new Respon();
    // }

    public function rules()
    {
        return [
            'namaRespon' => [
                'required',
                Rule::unique('respon', 'nama_respon')->ignore($this->respon->nama_respon),
                'min:4',
                'max:50',
                'string'
            ],
            'iconRespon' => [
                'required',
                Rule::unique('respon', 'icon_respon')->ignore($this->respon->icon_respon),
                'min:6',
                'max:32',
                'string'
            ],
            'skorRespon' => [
                'required',
                Rule::unique('respon', 'skor_respon')->ignore($this->respon->skor_respon),
                'min:0',
                'max:9',
                'numeric'
            ],
            'urutanRespon' => [
                'required',
                Rule::unique('respon', 'urutan_respon')->ignore($this->respon->urutan_respon),
                'min:1',
                'max:10',
                'numeric'
            ],
            'tagWarnaRespon' => [
                'required',
                Rule::unique('respon', 'tag_warna_respon')->ignore($this->respon->tag_warna_respon),
                'hex_color'
            ],
        ];
    }

    public function messages()
    {
        return [
            'namaRespon' => [
                'required' => 'masukan nama respon',
                'unique'   => 'nama respon sudah terpakai',
                'min'      => 'minimal 4 karakter',
                'max'      => 'maksimal 50 karakter',
            ],
            'iconRespon' => [
                'required' => 'masukan icon respon',
                'unique'   => 'icon respon sudah terpakai',
                'min'      => 'minimal 6 karakter',
                'max'      => 'maksimal 32 karakter',
            ],
            'skorRespon' => [
                'required' => 'masukan skor respon',
                'unique'   => 'skor respon sudah terpakai',
                'min'      => 'minimal angka 0',
                'max'      => 'maksimal angka 9',
            ],
            'urutanRespon' => [
                'required' => 'masukan urutan respon',
                'unique'   => 'urutan respon sudah terpakai',
                'min'      => 'minimal 1 angka',
                'max'      => 'maksimal 10 angka',
            ],
            'tagWarnaRespon' => [
                'required'  => 'masukan tag warna respon',
                'unique'    => 'tag warna respon sudah terpakai',
                'hex_color' => 'format warna hex',
            ],
        ];
    }

    public function setRespon(?Respon $r)
    {
        $this->respons        = $r;
        $this->id             = $r->id;
        $this->namaRespon     = $r->nama_respon;
        $this->iconRespon     = $r->icon_respon;
        $this->tagWarnaRespon = $r->tag_warna_respon;
        $this->hasQuestion    = $r->has_question ?? false;
        $this->skorRespon     = $r->skor_respon;
        $this->urutanRespon   = $r->urutan_respon;
    }

    public function store()
    {
        // dd($this->all());
        try {
            $respon                   = new Respon;
            $respon->nama_respon      = $this->namaRespon;
            $respon->icon_respon      = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->has_question     = $this->hasQuestion ?? false;
            $respon->skor_respon      = $this->skorRespon;
            $respon->urutan_respon    = $this->urutanRespon;
            $respon->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update()
    {
        try {
            // $this->validate();
            // dd($this->namaRespon);
            $respon                   = Respon::find($this->id);
            $respon->nama_respon      = $this->namaRespon;
            $respon->icon_respon      = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->has_question     = $this->hasQuestion;
            $respon->skor_respon      = $this->skorRespon;
            $respon->urutan_respon    = $this->urutanRespon;
            $respon->save();
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            // report($th);
            // return false;
            return $th->getMessage();
        }
    }
}
