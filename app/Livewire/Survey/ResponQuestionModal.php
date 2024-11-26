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
        if ($store) {
            $msg = 'Terimakasih telah menilai layanan';
            $ico = 'success';

            return $this->dispatch('nilai-layanan-final', message: $msg, icon: $ico);
        }
        $ico = 'error';

        return $this->dispatch('nilai-layanan-final', message: $store, icon: $ico);
    }

    public function simpanSurvey()
    {
        $store = $this->form->store($this->hasQuestion);
        if ($store) {
            $msg = 'Terimakasih telah menilai layanan';
            $ico = 'success';
            // $this->resetSurvey();

            return $this->dispatch('nilai-layanan-final', message: $msg, icon: $ico);
        }
        $ico = 'error';
        // $this->resetSurvey();

        return $this->dispatch('nilai-layanan-final', message: $store, icon: $ico);
    }

    #[Renderless]
    public function resetSurvey(): void
    {
        $this->form->reset();
    }
}
