<?php

namespace App\Livewire\Admin;

Use App\Http\Resources\UnitResource;
use App\Livewire\Forms\UnitForm as Form;
use App\Models\Unit as UnitModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Livewire\Attributes\Locked;

class Unit extends Component
{
    use LivewireAlert;

    public Form $form;

    #[Locked]
    public $id;

    // public function mount()
    // {
    //     $this->dispatch('table-updated');
    // }

    public function getListeners()
    {
        return [
            'confirmed',
            'cancelled',
        ];
    }

    public  function preDelete($id)
    {
        // dd($id);
        $unit = UnitModel::find($id);
        // dd($unit->id);
        $this->id = $unit->id;
        $this->confirm('Anda yakin akan menghapus data ini ?', [
            'icon' => 'question',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Batal',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        try {
            $unit = UnitModel::find($this->id);
            $unit->delete();
            return $this->alert('success', 'berhasil', [
                'position' => 'center',
                'toast' => true,
                'text' => 'data unit berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return $this->alert('warning', 'gagal', [
                'position' => 'center',
                'toast' => true,
                'text' => $th->getMessage(),
            ]);
        }
    }

    public function save()
    {
        $store = $this->form->store();
        if ($store) {
            // $this->alert('success', 'berhasil', [
            //     'position' => 'center',
            //     'toast' => true,
            //     'text' => 'data unit berhasil disimpan',
            // ]);
            $this->dispatch('table-updated');
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
