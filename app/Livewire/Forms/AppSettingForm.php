<?php

namespace App\Livewire\Forms;

use App\Models\AppSetting;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AppSettingForm extends Form
{
    public ?AppSetting $app;

    #[Locked]
    public $id;

    #[Validate('required', message: 'mohon unggah domain logo', onUpdate: false)]
    public $initialDomain;

    #[Validate('required', message: 'mohon unggah main logo', onUpdate: false)]
    public $initialBody;

    #[Validate('required', message: 'mohon unggah header logo', onUpdate: false)]
    public $initialHeader;

    #[Validate('required', message: 'mohon unggah domain logo', onUpdate: false)]
    public $initialDomainImg;

    #[Validate('required', message: 'mohon unggah main logo', onUpdate: false)]
    public $initialBodyImg;

    #[Validate('required', message: 'mohon unggah header logo', onUpdate: false)]
    public $initialHeaderImg;

    #[Validate('required', message: 'mohon isi alamat', onUpdate: false)]
    #[Validate('min:20', message: 'alamat terlau pendek minimal 20 huruf', onUpdate: false)]
    #[Validate('max:50', message: 'alamat terlau panjang maksimal 50 huruf', onUpdate: false)]
    public $initialAlamat;

    #[Validate('required', message: 'mohon isi alamat', onUpdate: false)]
    #[Validate('min:20', message: 'motto terlau pendek minimal 20 huruf', onUpdate: false)]
    #[Validate('max:100', message: 'motto terlau panjang maksimal 100 huruf', onUpdate: false)]
    public $initialMotto;

    public function setSetting(AppSetting $app)
    {
        $this->app              = $app;
        $this->id               = $app->id;
        $this->initialDomainImg = $app->initial_domain_logo;
        $this->initialHeaderImg = $app->initial_header_logo;
        $this->initialBodyImg   = $app->initial_body_logo;
        $this->initialAlamat    = $app->initial_alamat_text;
        $this->initialMotto     = $app->initial_moto_text;
    }

    public function store()
    {
        try {
            $setting                      = AppSetting::firstOrNew(['id' => $this->id]);
            $setting->initial_domain_logo = $this->initialDomainImg;
            $setting->initial_header_logo = $this->initialHeaderImg;
            $setting->initial_body_logo   = $this->initialBodyImg;
            $setting->initial_alamat_text = $this->initialAlamat;
            $setting->initial_motto_text  = $this->initialMotto;
            $setting->save();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
