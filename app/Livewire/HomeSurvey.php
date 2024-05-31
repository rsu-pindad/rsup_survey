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

    public function mount()
    {
        Carbon::setLocale('id');
        // $time = \Carbon\Carbon::now()->shiftTimezone('Asia/Jakarta');
        $time = Carbon::now()->setTimezone('Asia/Jakarta');
        $this->time = $time;
    }

    public function getListeners()
    {
        return [
            'confirmed',
            'confirmedDataDiri',
            'cancelled',
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
        if ($this->hasQuestion == true) {
            return $this->dispatch('modal-data-diri')->self();
        }
        return $this->confirm('apakah bersedia isi data diri ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmedDataDiri',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Isi',
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
        if ($store != 1) {
            return $this->flash('error', 'Gagal Menilai Layanan', [
                'position' => 'center',
                'toast' => true,
                'text' => $store,
            ]);
        }
        return $this->flash('success', 'berhasil', [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
            'text' => 'terimakasih telah mengikuti peniliaian survey kami'
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
        // dd(session()->get('penjamin_layanan_id'));
        $penjamin = Penjamin::where('id', session()->get('penjamin_layanan_id'))->sole();
        // dd($penjamin);
        return view('livewire.home-survey')->with([
            'petugas' => session()->get('userName'),
            'layanan' => $layananKaryawan->parentLayanan->nama_layanan,
            'unitNama' => $layananKaryawan->parentUnit->nama_unit,
            'unitAlamat' => $unit->unitProfil->unit_alamat ?? $appSetting->initial_alamat_text,
            'subLogo' => $unit->unitProfil->unit_sub_logo ?? 'settings/' . $appSetting->initial_header_logo,
            'respons' => $sorted->values()->all(),
            'penjamin' => $penjamin->nama_penjamin,
        ]);
    }
}
