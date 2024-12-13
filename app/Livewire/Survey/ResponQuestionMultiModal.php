<?php

namespace App\Livewire\Survey;

use App\Livewire\Forms\Survey\MultiPasienForm;
use Livewire\Attributes\On;
use Livewire\Component;

class ResponQuestionMultiModal extends Component
{
    public MultiPasienForm $form;
    public $hasQuestion   = false;
    public $dataNilai     = [];
    public $stateQuestion = false;

    public function render()
    {
        return view('livewire.survey.respon-question-multi-modal');
    }

    #[On('isi-form-data-diri')]
    public function readyState($dataNilai, $stateQuestion)
    {
        $this->form->setData($dataNilai, $stateQuestion);
    }

    public function simpanSurvey()
    {
        $store = $this->form->store();
        if ($store === 0) {
            $this->form->resetForm();
            $descMessage = 'Terimakasih telah mengisi survey kami, Survey anda sangat berarti bagi kami, lekas sembuh';

            return $this->dispatch('end-survey', icons: 'success', desc: $descMessage);
        }
        $this->form->resetForm();

        return $this->dispatch('end-survey', icons: 'error', desc: $store);
    }

    public function resetSurvey()
    {
        $store = $this->form->resetForm();
    }

    #[On('skip-question-state')]
    public function skipQuestionState($dataNilai, $stateQuestion)
    {
        $this->form->setData($dataNilai, $stateQuestion);
        $store = $this->form->store();
        if ($store === 0) {
            $this->form->resetForm();
            $descMessage = 'Terimakasih telah mengisi survey kami, Survey anda sangat berarti bagi kami, lekas sembuh';

            return $this->dispatch('end-survey', icons: 'success', desc: $descMessage);
        }
        $this->form->resetForm();

        return $this->dispatch('end-survey', icons: 'error', desc: $store);
    }
}
