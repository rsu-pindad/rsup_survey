<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Respon;
use Livewire\Component;
use App\Models\Penjamin;
use App\Models\AppSetting;
use App\Models\LayananRespon;
use App\Models\KaryawanProfile;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
// use Spatie\Color\Rgba;
// use Spatie\Color\Hex;
use App\Livewire\Forms\SurveyPasienForm as Form;

class HomeSurvey extends Component
{
    use LivewireAlert;

    public Form $form;
    public $hasQuestion = false;
    public $namaRespon  = '';
    public $skorRespon  = '';

    #[Validate('required', message: 'mohon masukan nama anda')]
    #[Validate('string', message: 'hanya huruf')]
    #[Validate('min:3', message: 'minimal 3 huruf')]
    public $namaPasien = '';

    #[Validate('required', message: 'mohon masukan nomor telepon')]
    #[Validate('numeric', message: 'hanya angka')]
    #[Validate('min:9', message: 'minimal 9 angka')]
    public $teleponPasien = '';

    public $hideRespon = false;

    public function boot()
    {
        if (session()->get('multiPenilaian') === true && session()->get('userLayananMulti') === true) {
            // Multiple
            // return redirect()->route('isi-survey-pelayanan-multi');
            return abort(404);
        }

        if (session()->get('userLayananMulti') === true) {
            return abort(404);
        }
    }

    public function getListeners()
    {
        return [
            'confirmed',
            'cancelled',
            'confirmedDataDiri',
            'cancelledDataDiri'
        ];
    }

    public function cancelled()
    {
        $this->namaRespon    = '';
        $this->skorRespon    = '';
        $this->namaPasien    = '';
        $this->teleponPasien = '';
        $this->hasQuestion   = false;
        $this->hideRespon    = false;
    }

    public function confirmed()
    {
        // dd($this->hasQuestion);
        if ($this->hasQuestion === true) {
            return $this->dispatch('modal-data-diri')->self();
        }

        return $this->confirm('apakah bersedia isi data diri ?', [
            'icon'              => 'question',
            'onConfirmed'       => 'confirmedDataDiri',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Isi',
            'cancelButtonText'  => 'Tidak',
            'onDismissed'       => 'cancelledDataDiri'
        ]);
    }

    public function confirmedDataDiri()
    {
        return $this->dispatch('modal-data-diri')->self();
    }

    public function cancelledDataDiri()
    {
        $this->hideRespon = false;
        $this->save();
    }

    public function preSave($id)
    {
        $this->hideRespon = true;
        $respon            = Respon::find($id);
        $this->namaRespon  = $respon->nama_respon;
        $this->skorRespon  = $respon->skor_respon;
        $this->hasQuestion = $respon->has_question;
        $this->confirm('Beri nilai ' . $this->namaRespon . ' ?', [
            'icon'              => 'question',
            'onConfirmed'       => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Nilai',
            'cancelButtonText'  => 'Batal',
            'onDismissed'       => 'cancelled'
        ]);
    }

    public function save()
    {
        if ($this->hasQuestion === true) {
            $this->validate();
        }
        session()->put('namaRespon', $this->namaRespon);
        session()->put('skorRespon', $this->skorRespon);
        session()->put('namaPasien', $this->namaPasien);
        session()->put('teleponPasien', $this->teleponPasien);
        // dd(session()->get('skorRespon'));
        $store = $this->form->save();
        if ($store !== true) {
            return $this->flash('error', 'gagal menilai layanan', [
                'position'         => 'bottom',
                'toast'            => false,
                'text'             => $store,
                'timer'            => '10000',
                'timerProgressBar' => true,
            ]);
        }

        return $this->flash('success', 'berhasil', [
            'position'         => 'center',
            'toast'            => false,
            'text'             => 'terimakasih telah mengikuti peniliaian survey kami',
            'timerProgressBar' => true,
        ], '/');
    }

    #[Layout('components.layouts.beranda')]
    public function render()
    {
        // $layananKaryawan = KaryawanProfile::with('parentLayanan')->where('user_id', session()->get('userId'))->first();
        $layananKaryawan = Cache::remember('karyawanProfile', 60, function () {
            return KaryawanProfile::with(['parentLayanan','parentUnit'])->where('user_id', session()->get('userId'))->first();
        });
        $respon = Cache::remember('layananRespon', 60, function () use ($layananKaryawan) {
            return LayananRespon::distinct()
                       ->where('layanan_id', $layananKaryawan->layanan_id)
                       ->with([
                           'parentRespon' => function ($query) {
                               $query->orderBy('urutan_respon', 'ASC');
                           },
                       ])
                       ->orderBy('layanan_id', 'DESC')
                       ->get();
        });
        // $respon = LayananRespon::distinct()
        //               ->where('layanan_id', $layananKaryawan->layanan_id)
        //               ->with([
        //                   'parentRespon' => function ($query) {
        //                       $query->orderBy('urutan_respon', 'ASC');
        //                   },
        //               ])
        //               ->orderBy('layanan_id', 'DESC')
        //               ->get();
        $collectionRespon = collect((object) $respon->pluck('parentRespon'));
        $sorted           = $collectionRespon->sortBy('urutan_respon');
        // $unit             = Unit::with('unitProfil')->find($layananKaryawan->parentUnit->id);
        $unit = Cache::remember('unit', 60, function () use ($layananKaryawan) {
            return Unit::with('unitProfil')->find($layananKaryawan->parentUnit->id);
        });
        $appSetting = Cache::remember('appSetting', 60, function(){
            return AppSetting::get()->last();
        });
        // $appSetting = AppSetting::get()->last();
        $penjamin = Cache::remember('penjamin', 60, function(){
            return Penjamin::find(session()->get('penjamin_layanan_id'));
        });
        // $penjamin   = Penjamin::find(session()->get('penjamin_layanan_id'))->nama_penjamin;

        return view('livewire.home-survey')->with([
            'petugas'  => $layananKaryawan->nama_karyawanprofile,
            'layanan'  => $layananKaryawan->parentLayanan->nama_layanan,
            'unitNama' => $layananKaryawan->parentUnit->nama_unit,
            'subLogo'  => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
            'respons'  => $sorted->values()->all(),
            'penjamin' => $penjamin->nama_penjamin,
        ]);
    }
}
