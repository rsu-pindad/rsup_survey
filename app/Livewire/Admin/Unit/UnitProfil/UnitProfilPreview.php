<?php

namespace App\Livewire\Admin\Unit\UnitProfil;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\UnitProfil;

class UnitProfilPreview extends Component
{
    // #[Reactive]
    public $unitProfil;

    public $unitName;

    public function mount($unitProfil, $unitName)
    {
        $this->unitProfil = UnitProfil::where('unit_id',$unitProfil)->first() ?? '';
        $this->unitMainLogo = $this->unitProfil->unit_main_logo ?? 'default.png';
        $this->unitSubLogo = $this->unitProfil->unit_sub_logo ?? 'default.png';
        $this->unitAlamat = $this->unitProfil->unit_alamat ?? 'alamat blm diset';
        $this->unitMotto = $this->unitProfil->unit_motto ?? 'motto blm diset';
        $this->unitName = $unitName;
    }

    public function render()
    {
        // dd($this->unitProfil->id);
        // dd($this->unitAlamat);
        return view('livewire.admin.unit.unit-profil.unit-profil-preview');
    }
}
