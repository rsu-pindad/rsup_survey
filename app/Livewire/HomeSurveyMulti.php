<?php

namespace App\Livewire;

use App\Livewire\Forms\SurveyPasienMultiForm as Form;
use App\Models\AppSetting;
use App\Models\KaryawanProfile;
use App\Models\Layanan;
use App\Models\LayananRespon;
use App\Models\MultiLayanan;
use App\Models\Penjamin;
use App\Models\Respon;
use App\Models\Unit;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Validate;
use Livewire\Component;

class HomeSurveyMulti extends Component
{
    use LivewireAlert;

    public Form $form;

    public $rememberState = false;

    public $setLayanan = false;

    public $hasQuestion = false;

    public $mustQuestion = false;

    public $jumlahLayanan = 0;

    public $incrementNilai = 0;

    #[Validate('required', message: 'mohon isi nama anda')]
    #[Validate('min:3', message: 'minimal 3 huruf')]
    #[Validate('max:50', message: 'maksimal 50 huruf')]
    public $namaPasien;

    #[Validate('required', message: 'mohon isi nomor telepon')]
    #[Validate('numeric')]
    #[Validate('min:9', message: 'minimal 9 angka')]
    public $teleponPasien;

    #[Locked]
    public $namaRespon = '';

    #[Locked]
    public $namaLayanan = '';

    #[Locked]
    public $skorRespon = '';

    #[Locked]
    public $listRespon = [];

    #[Locked]
    public $penjamin;

    #[Locked]
    public $selectedLayananId = '';

    #[Locked]
    public $multiLayanan = [];

    public $time;

    public function getListeners()
    {
        return [
            'confirmed',
            'cancelled',
            'confirmedDataDiri',
            'confirmedReset',
        ];
    }

    public function mount()
    {
        Carbon::setLocale('id');
        $this->time = Carbon::now()->setTimezone('Asia/Jakarta');
        session()->put(['idLayanan', null]);
        session()->put(['jawabanPasien', []]);
        // session()->put('mustQuestion', false);
    }

    #[On('refresh-layanan')]
    public function rendering()
    {
        $this->multiLayanan = MultiLayanan::with('parentLayanan')->where('unit_id', session()->get('userUnitId'))->get();
        $this->penjamin = Penjamin::find(session()->get('penjamin_layanan_id'))->nama_penjamin;
        $this->jumlahLayanan = count($this->multiLayanan);
    }

    public function cancelled()
    {
        $this->namaRespon = '';
        $this->skorRespon = '';
        $this->namaLayanan = '';
        $this->hasQuestion = false;
    }

    public function confirmed()
    {
        if ($this->hasQuestion === 1) {
            $this->mustQuestion = true;
            session()->put('mustQuestion', true);
        }
        session()->push('jawabanPasien', [
            'namaLayanan' => $this->namaLayanan,
            'namaRespon' => $this->namaRespon,
            'skorRespon' => $this->skorRespon,
            'hasQuestion' => $this->hasQuestion,
        ]);
        $this->incrementNilai += 1;
        // $incrementNilaiLokal = $this->incrementNilai;
        // session()->put('incrementNilai', $incrementNilaiLokal);
        session()->put('incrementNilai', $this->incrementNilai);
        session()->push('idLayanan', $this->selectedLayananId);
        $this->setLayanan = false;
        $this->alert('success', 'berhasil', [
            'position' => 'top',
            'toast' => true,
            'text' => 'tersimpan',
            'timer' => '1000',
            'timerProgressBar' => true,
        ]);
        // if(session()->get('incrementNilai') == $this->jumlahLayanan){
        if ($this->incrementNilai == $this->jumlahLayanan) {
            $this->selectedLayananId = null;
            // return $this->dispatch('info-survey')->self();
            return $this->dispatch('same-jumlah')->self();
        }
        return $this->dispatch('refresh-layanan')->self();
    }

    public function confirmedDataDiri()
    {
        return $this->dispatch('modal-data-diri')->self();
    }

    public function confirmedReset()
    {
        $this->incrementNilai = 0;
        $this->selectedLayananId;
        $this->rememberState = false;
        session()->forget(['idLayanan', 'jawabanPasien']);
        session()->put('incrementNilai', $this->incrementNilai);
        session()->put('mustQuestion', false);
        $this->dispatch('ulangi-survey-diri');
        return $this->dispatch('refresh-layanan')->self();
    }

    #[On('info-survey')]
    public function infoSurvey()
    {
        // $this->alert('info', 'mohon tunggu', [
        //     'position' => 'center',
        //     'toast' => false,
        //     'timer' => '5000',
        //     'timerProgressBar' => true,
        // ]);
        return $this->dispatch('same-jumlah')->self();
    }

    #[On('ulangi-survey')]
    public function ulangi()
    {
        $this->alert('info', 'Ulangi', [
            'position' => 'bottom',
            'timer' => '10000',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmedReset',
            'confirmButtonText' => 'Iya',
            'showCancelButton' => true,
            'onDismissed' => '',
            'cancelButtonText' => 'Tidak',
            'timerProgressBar' => true,
        ]);
    }

    #[On('show-layanan')]
    public function showLayanan($id)
    {
        $this->setLayanan = false;
        $this->selectedLayananId = $id;
        $respon = LayananRespon::distinct()
            ->where('layanan_id', $id)
            ->with([
                'parentRespon' => function ($query) {
                    $query->orderBy('urutan_respon', 'ASC');
                },
            ])
            ->orderBy('layanan_id', 'DESC')
            ->get();
        $collectionRespon = collect((object) $respon->pluck('parentRespon'));
        $sorted = $collectionRespon->sortBy('urutan_respon');
        $this->listRespon = $sorted->values()->all();
        $this->setLayanan = true;
    }

    #[On('pre-save')]
    public function preSave($id)
    {
        $this->dispatch('refresh-layanan')->self();
        $respon = Respon::find($id);
        // $this->idRespon = $respon->id;
        $this->namaRespon = $respon->nama_respon;
        $this->skorRespon = $respon->skor_respon;
        $this->hasQuestion = $respon->has_question;
        // dd($this->hasQuestion);
        $this->namaLayanan = Layanan::find($this->selectedLayananId)->nama_layanan;
        return $this->confirm('Beri nilai ' . $this->namaRespon . ' ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Nilai',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function saveModal()
    {
        $this->validate();
        session()->put('namaPasien', $this->namaPasien);
        session()->put('teleponPasien', $this->teleponPasien);
        return $this->dispatch('store-jawaban')->self();
    }

    #[On('same-jumlah')]
    public function preStore()
    {
        if (session()->get('mustQuestion') == true) {
            $this->rememberState = true;
            return $this->dispatch('modal-data-diri')->self();
        }
        return $this->dispatch('store-jawaban')->self();
    }

    #[On('store-jawaban')]
    public function stores()
    {
        $store = $this->form->save();
        // dd($store);
        if ($store < 1) {
            return $this->alert('error', 'gagal menilai layanan', [
                'position' => 'bottom',
                'toast' => false,
                'text' => $store,
                'timer' => '10000',
                'timerProgressBar' => true,
            ]);
        }
        $this->setLayanan = false;
        session()->forget([
            'mustQuestion',
            'namaPasien',
            'teleponPasien',
            'incrementNilai',
            'jawabanPasien',
            'idLayanan',
            'shift',
            'skorRespon',
            'namaRespon'
        ]);
        return $this->flash('success', 'berhasil', [
            'position' => 'center',
            'toast' => false,
            'timer' => '3000',
            'text' => 'terimakasih telah mengikuti survey kami',
            'timerProgressBar' => true,
        ], route('roots-dashboard'));
    }

    // #[Renderless]
    #[Layout('components.layouts.beranda')]
    public function render()
    {
        $layananKaryawan = KaryawanProfile::with('parentLayanan')->where('user_id', session()->get('userId'))->first();

        $unit = Unit::with('unitProfil')->find($layananKaryawan->parentUnit->id);
        // dd($unitMulti);
        $appSetting = AppSetting::get()->last();
        return view('livewire.home-survey-multi')->with([
            'petugas' => $layananKaryawan->nama_karyawanprofile,
            'unitNama' => $layananKaryawan->parentUnit->nama_unit,
            'subLogo' => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
        ]);
    }
}
