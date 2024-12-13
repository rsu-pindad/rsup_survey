<?php

namespace App\Livewire\Survey;

use App\Livewire\Forms\Survey\SinglePasienForm;
use App\Models\Respon;
use Livewire\Attributes\{On, Renderless};
use Livewire\Component;

class ResponQuestionModal extends Component
{
    public SinglePasienForm $form;
    public $hasQuestion = false;

    public function render()
    {
        return view('livewire.survey.respon-question-modal');
    }

    #[On('opening-modal')]
    public function updatePostList($responId, $penjaminData)
    {
        $this->hasQuestion = $this->form->setRespon(intval($responId));
        $this->form->setPenjamin($penjaminData);
    }

    #[On('opening-modal-noquestion')]
    public function updateQuestion($skipQuestion, $responId, $penjaminData)
    {
        $this->hasQuestion = $skipQuestion;
        // $this->hasQuestion = $this->form->setRespon(intval($responId));
        // $this->form->setPenjamin($penjaminData);
        $this->form->penjaminData = $penjaminData;
        $this->form->responData   = Respon::find(intval($responId));
    }

    #[On('skip-question-insert')]
    public function skipped($skipQuestion, $respon, $penjaminData)
    {
        // $this->hasQuestion = $this->form->setRespon(intval($respon));
        $this->form->penjaminData = $penjaminData;
        $this->form->responData   = Respon::find(intval($respon));
        $store                    = $this->form->store($skipQuestion);
        if ($store === 0) {
            $this->form->resetForm();

            return $this->dispatch('nilai-layanan-final', desc: 'Terimakasih telah menilai layanan', icons: 'success');
        }
        $this->form->resetForm();

        return $this->dispatch('nilai-layanan-final', desc: $store, icons: 'error');
    }

    public function simpanSurvey()
    {
        $store = $this->form->store($this->hasQuestion);
        if ($store === 0) {
            $this->form->resetForm();

            return $this->dispatch('nilai-layanan-final', desc: 'Terimakasih telah menilai layanan', icons: 'success');
        }
        $this->form->resetForm();

        return $this->dispatch('nilai-layanan-final', desc: $store, icons: 'error');
    }

    #[Renderless]
    public function resetSurvey()
    {
        $this->form->resetForm();
    }
}
