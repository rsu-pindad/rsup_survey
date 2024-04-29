<?php

namespace App\Livewire\Admin;

Use App\Http\Resources\UnitResource;
use App\Livewire\Forms\UnitForm as Form;
use App\Models\Unit as UnitModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Unit extends Component
{
    use LivewireAlert;

    public Form $form;

    public function delete()
    {
        $this->alert('success', 'berhasil', [
            'position' => 'center',
            'toast' => true,
            'text' => 'data unit berhasil disimpan',
        ]);
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data unit berhasil disimpan',
            ]);
        } else {
            $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $store,
            ]);
        }
    }

    public function render()
    {
        $units = UnitModel::latest()->get();
        return view('livewire.admin.unit')->with([
            'units' => UnitResource::collection($units),
        ]);
    }
}
