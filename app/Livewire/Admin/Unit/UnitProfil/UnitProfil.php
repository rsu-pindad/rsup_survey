<?php

namespace App\Livewire\Admin\Unit\UnitProfil;

use App\Livewire\Forms\UnitProfilForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class UnitProfil extends Component
{
    use LivewireAlert;

    public Form $form;

    public $mainLogo;

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
        $store = $this->form->store();
        if ($store == true) {
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'unit profil berhasil disimpan',
            ]);
        }
        return $this->alert('warning', 'gagal', [
            'position' => 'center',
            'toast' => true,
            'text' => 'terjadi kesalahan',
        ]);
    }
}
