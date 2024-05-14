<?php

namespace App\Livewire\Admin\Unit\UnitProfil;

use App\Livewire\Forms\UnitProfilForm as Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Joelwmale\LivewireQuill\Traits\HasQuillEditor;
use Livewire\Attributes\On;
use Livewire\Component;

class UnitProfil extends Component
{
    use HasQuillEditor, LivewireAlert;

    public Form $form;

    public $editorId;

    public function mount($id)
    {
        $this->unitId = $id;
        $this->form->setUnit($this->unitId);
    }

    public function contentChanged($editorId, $content)
    {
        // $editorId is the id use when you initiated the livewire component
        // $content is the raw text editor content

        // save to the local variable...
        // $this->content = $content;
        $this->form->unitAlamat = $content;
    }

    // #[On('contentUpdated')]
    // public function setUnit($editorId, $content)
    // {
    //     $this->editorId = $editorId;
    //     // $this->form->unitAlamat = $this->content;
    //     dd($content);
    // }

    public function render()
    {
        return view('livewire.admin.unit.unit-profil.unit-profil');
    }

    public function save()
    {
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
