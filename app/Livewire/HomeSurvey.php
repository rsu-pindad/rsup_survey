<?php

namespace App\Livewire;

use App\Livewire\Forms\SurveyPasienForm as Form;
use App\Models\AppSetting;
use App\Models\KaryawanProfile;
use App\Models\LayananRespon;
use App\Models\Penjamin;
use App\Models\Respon;
use App\Models\Unit;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
// use Spatie\Color\Rgba;
// use Spatie\Color\Hex;

class HomeSurvey extends Component
{
    use LivewireAlert;

    public Form $form;

    public $hasQuestion = false;

    public $namaRespon = '';

    public $skorRespon = '';

    public function boot()
    {
        if (session()->get('multiPenilaian') !== 0 && session()->get('userLayananMulti') !== 0) {
            // Multiple
            // return redirect()->route('isi-survey-pelayanan-multi');
            return abort(404);
        }
    }

    public function mount()
    {
        Carbon::setLocale('id');
        $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
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
        $this->namaRespon = '';
        $this->skorRespon = '';
        $this->hasQuestion = false;
    }

    public function confirmed()
    {
        if ($this->hasQuestion === true) {
            return $this->dispatch('modal-data-diri')->self();
        }
        return $this->confirm('apakah bersedia isi data diri ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmedDataDiri',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Iya',
            'cancelButtonText' => 'Tidak',
            'onDismissed' => 'cancelledDataDiri'
        ]);
    }

    public function confirmedDataDiri()
    {
        return $this->dispatch('modal-data-diri')->self();
    }

    public function cancelledDataDiri()
    {
        $this->save();
    }

    public function preSave($id)
    {
        $respon = Respon::find($id);
        $this->namaRespon = $respon->nama_respon;
        $this->skorRespon = $respon->skor_respon;
        $this->hasQuestion = $respon->has_question;
        $this->confirm('Beri nilai ' . $this->namaRespon . ' ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Nilai',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function save()
    {
        session()->put('namaRespon', $this->namaRespon);
        session()->put('skorRespon', $this->skorRespon);
        // dd(session()->get('skorRespon'));
        $store = $this->form->save();
        if ($store !== 1) {
            return $this->flash('error', 'gagal menilai layanan', [
                'position' => 'bottom',
                'toast' => false,
                'text' => $store,
                'timer' => '10000',
                'timerProgressBar' => true,
            ]);
        }
        return $this->flash('success', 'berhasil', [
            'position' => 'center',
            'toast' => false,
            'text' => 'terimakasih telah mengikuti peniliaian survey kami',
            'timerProgressBar' => true,
        ], '/');
    }

    #[Layout('components.layouts.beranda')]
    public function render()
    {
        $layananKaryawan = KaryawanProfile::with('parentLayanan')->where('user_id', session()->get('userId'))->first();
        $respon = LayananRespon::distinct()
            ->where('layanan_id', $layananKaryawan->layanan_id)
            ->with([
                'parentRespon' => function ($query) {
                    $query->orderBy('urutan_respon', 'ASC');
                },
            ])
            ->orderBy('layanan_id', 'DESC')
            ->get();
        $collectionRespon = collect((object) $respon->pluck('parentRespon'));
        $sorted = $collectionRespon->sortBy('urutan_respon');
        $unit = Unit::with('unitProfil')->find($layananKaryawan->parentUnit->id);
        $appSetting = AppSetting::get()->last();
        $penjamin = Penjamin::find(session()->get('penjamin_layanan_id'))->nama_penjamin;
        return view('livewire.home-survey')->with([
            'petugas' => $layananKaryawan->nama_karyawanprofile,
            'layanan' => $layananKaryawan->parentLayanan->nama_layanan,
            'unitNama' => $layananKaryawan->parentUnit->nama_unit,
            'subLogo' => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
            'respons' => $sorted->values()->all(),
            'penjamin' => $penjamin,
        ]);
    }
}
