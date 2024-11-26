<?php

namespace App\Livewire\Survey;

use Livewire\Attributes\{Lazy, Locked};
use Livewire\Component;

#[Lazy]
class ResponCard extends Component
{
    #[Locked]
    public $colorText;

    #[Locked]
    public $namaRespon;

    #[Locked]
    public $iconRespon;

    public function mount($colorText, $namaRespon, $iconRespon)
    {
        $this->colorText  = $colorText;
        $this->namaRespon = $namaRespon;
        $this->iconRespon = $iconRespon;
    }

    public function placeholder()
    {
        return view('components.preline.survey.placeholder');
    }

    public function render()
    {
        return view('livewire.survey.respon-card')->with([
            'colorText'  => $this->colorText,
            'namaRespon' => $this->namaRespon,
            'iconRespon' => $this->iconRespon
        ]);
    }
}
