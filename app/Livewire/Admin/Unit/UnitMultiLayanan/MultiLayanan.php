<?php

namespace App\Livewire\Admin\Unit\UnitMultiLayanan;

use Livewire\Component;
use App\Models\MultiLayanan as Multi;
use Livewire\Attributes\Locked;
use App\Models\Unit;
use App\Models\Layanan;

class MultiLayanan extends Component
{

    #[Locked]
    public $unitId;

    #[Locked]
    public $unitNama;

    public $layananSelect = [];

    public $urutanLayanan = [];

    public function mount($id)
    {
        $this->unit = Unit::find($id);
        $this->unitId = $this->unit->id;
        $this->unitNama = $this->unit->nama_unit;
        $this->unitHasMulti = $this->unit->unitMultiLayanan->pluck('id');
        // dd($this->unitHasMulti);
        $this->layananSelect = $this->unitHasMulti;
    }

    public function update()
    {
        $this->dispatch('contentChanged');
    }

    #[On('contentChanged')]
    public function updated()
    {
        $unit = Unit::find($this->unitId);
        $unit->unitMultiLayanan()->sync($this->layananSelect, true);
    }

    public function render()
    {
        $multi = Multi::where('unit_id', $this->unitId)->get();
        $layanans = Layanan::where('multi_layanan', false)->get(['id','nama_layanan']);
        return view('livewire.admin.unit.unit-multi-layanan.multi-layanan')->with([
            'layanan' => $layanans,
        ]);
    }
}
