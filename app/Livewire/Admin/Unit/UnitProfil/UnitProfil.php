<?php

namespace App\Livewire\Admin\Unit\UnitProfil;

use App\Livewire\Forms\UnitProfilForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UnitProfil extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    #[Validate('required', message: 'mohon unggah logo utama')]
    public $mainLogo;

    #[Validate('required', message: 'mohon unggah logo kedua')]
    public $subLogo;

    public function mount($id)
    {
        $this->unitId = $id;
        $this->form->setUnit($this->unitId);
    }

    public function render()
    {
        return view('livewire.admin.unit.unit-profil.unit-profil');
    }

    public function save()
    {
        $this->form->unitMainLogo = $this->mainLogo;
        $this->form->unitSubLogo = $this->subLogo;
        $this->unitId = $this->id;
        // dd($this->mainLogo);
        // $this->validate();
        try {
            $store = $this->form->store();
            if ($store == true) {
                return $this->flash('success', 'berhasil', [
                    'position' => 'center',
                    'toast' => true,
                    'text' => 'unit profil berhasil disimpan',
                ], route('root-unit-profil', $this->unitId));
            }
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => 'terjadi kesalahan',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }
}
