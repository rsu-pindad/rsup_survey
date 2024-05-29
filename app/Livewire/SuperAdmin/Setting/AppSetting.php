<?php

namespace App\Livewire\SuperAdmin\Setting;

use App\Livewire\Forms\AppSettingForm as Form;
use App\Models\AppSetting as Apps;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AppSetting extends Component
{
    use LivewireAlert;

    public Form $form;

    public function mount(Apps $app)
    {
        $this->form->setSetting($app);
    }

    public function save()
    {
        $this->form->validate();
    }

    public function render()
    {
        return view('livewire.super-admin.setting.app-setting');
    }
}
