<?php

namespace App\Livewire\Admin\Unit\UnitProfil;

use App\Livewire\Forms\UnitProfilForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UnitProfil extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

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
        $store = $this->form->store();
        if ($store !== true) {
            return $this->alert('error', 'gagal', [
                'position' => 'bottom',
                'timer' => '10000',
                'toast' => false,
                'text' => $store,
                'timerProgressBar' => true,
            ]);
        }
        return $this->flash('success', 'berhasil', [
            'position' => 'top',
            'toast' => false,
            'timerProgressBar' => true,
            'text' => 'unit profil berhasil disimpan',
        ], route('root-unit-profil', $this->id));
    }
}
