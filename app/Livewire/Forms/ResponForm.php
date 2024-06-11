<?php

namespace App\Livewire\Forms;

use App\Models\Respon;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class ResponForm extends Form
{
    #[Locked]
    public $id;
    
    public $namaRespon = '';

    public $iconRespon = '';

    public $skorRespon = '';

    public $urutanRespon = '';

    public $tagWarnaRespon = '';

    public $hasQuestion = false;

    public function rules()
    {
        return [
            'namaRespon' => [
                'required',
                ValidationRule::unique('respon', 'nama_respon')->ignore($this->namaRespon),
                'min:4',
                'max:50',
                'string'
            ],
            'iconRespon' => [
                'required',
                ValidationRule::unique('respon', 'icon_respon')->ignore($this->iconRespon),
                'min:6',
                'max:32',
                'string'
            ],
            'skorRespon' => [
                'required',
                ValidationRule::unique('respon', 'skor_respon')->ignore($this->skorRespon),
                'min:0',
                'max:9',
                'numeric'
            ],
            'urutanRespon' => [
                'required',
                ValidationRule::unique('respon', 'urutan_respon')->ignore($this->urutanRespon),
                'min:1',
                'max:10',
                'numeric'
            ],
            'tagWarnaRespon' => [
                'required',
                ValidationRule::unique('respon', 'tag_warna_respon')->ignore($this->tagWarnaRespon),
                'hex_color'
            ],
        ];
    }

    public function messages()
    {
        return [
            'namaRespon' => [
                'required' => 'masukan nama respon',
                'unique' => 'nama respon sudah terpakai',
                'min' => 'minimal 4 karakter',
                'max' => 'maksimal 50 karakter',
            ],
            'iconRespon' => [
                'required' => 'masukan icon respon',
                'unique' => 'icon respon sudah terpakai',
                'min' => 'minimal 6 karakter',
                'max' => 'maksimal 32 karakter',
            ],
            'skorRespon' => [
                'required' => 'masukan skor respon',
                'unique' => 'skor respon sudah terpakai',
                'min' => 'minimal angka 0',
                'max' => 'maksimal angka 9',
            ],
            'urutanRespon' => [
                'required' => 'masukan urutan respon',
                'unique' => 'urutan respon sudah terpakai',
                'min' => 'minimal 1 angka',
                'max' => 'maksimal 10 angka',
            ],
            'tagWarnaRespon' => [
                'required' => 'masukan tag warna respon',
                'unique' => 'tag warna respon sudah terpakai',
                'hex_color' => 'format warna hex',
            ],
        ];
    }

    public function setRespon(?Respon $respons)
    {
        $this->respons = $respons;
        $this->id = $respons->id;
        $this->namaRespon = $respons->nama_respon;
        $this->iconRespon = $respons->icon_respon;
        $this->tagWarnaRespon = $respons->tag_warna_respon;
        $this->hasQuestion = $respons->has_question ?? false;
        $this->skorRespon = $respons->skor_respon;
        $this->urutanRespon = $respons->urutan_respon;
    }

    public function store()
    {
        // dd($this->all());
        try {
            $respon = new Respon;
            $respon->nama_respon = $this->namaRespon;
            $respon->icon_respon = $this->iconRespon;
            $respon->tag_warna_respon = $this->tagWarnaRespon;
            $respon->has_question = $this->hasQuestion ?? false;
            $respon->skor_respon = $this->skorRespon;
            $respon->urutan_respon = $this->urutanRespon;
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
            $this->validate();
            $respon = Respon::find($this->id);
            $respon->nama_respon = $this->only('namaRespon');
            $respon->icon_respon = $this->only('iconRespon');
            $respon->tag_warna_respon = $this->only('tagWarnaRespon');
            $respon->has_question = $this->only('hasQuestion');
            $respon->skor_respon = $this->only('skorRespon');
            $respon->urutan_respon = $this->only('urutanRespon');
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
