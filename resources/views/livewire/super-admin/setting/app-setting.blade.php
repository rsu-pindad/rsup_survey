<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5 my-5">
        <div class="rounded">
            <div class="card">
                <div class="card-header">
                    <h4>App Settings</h4>
                </div>
                <div class="card-body m-2">
                    <form 
                        wire:submit="save" 
                        enctype="multipart/form-data">
                        <div class="row d-flex flex-row align-items-center mb-2">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                <div class="card" style="width: 12rem;">
                                    <img 
                                        class="img-thumbnail rounded"
                                        src="{{ basset('photos/settings/'.$this->form->initialDomainImg ?? 'default_domain.png') }}" 
                                        alt="current_logo_domain">
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12">
                                <div class="input-group">
                                    <label for="initialDomain" class="input-group-text">Domain</label>
                                    <livewire:dropzone
                                        wire:model="form.initialDomain"
                                        :rules="['image','mimes:png,jpeg','max:512']"
                                        :multiple="false"
                                        :key="'logo-one'" />
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex flex-row align-items-center mb-2">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                <div class="card" style="width: 12rem;">
                                    <img 
                                        class="img-thumbnail rounded"
                                        src="{{ basset('photos/settings/'.$this->form->initialBodyImg ?? 'default_body.png') }}" 
                                        alt="current_logo_body">
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12">
                                <div class="input-group">
                                    <label for="initialBody" class="input-group-text">Main</label>
                                    <livewire:dropzone
                                        wire:model="form.initialBody"
                                        :rules="['image','mimes:png,jpeg,webp','max:1024']"
                                        :multiple="false"
                                        :key="'logo-two'" />
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex flex-row align-items-center mb-2">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                <div class="card" style="width: 12rem;">
                                    <img 
                                        class="img-thumbnail rounded"
                                        src="{{ basset('photos/settings/'.$this->form->initialHeaderImg ?? 'default_header.png') }}" 
                                        alt="current_logo_header">
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12">
                                <div class="input-group">
                                    <label for="form.initialHeader" class="input-group-text">Header</label>
                                    <livewire:dropzone
                                        wire:model="form.initialHeader"
                                        :rules="['image','mimes:png,jpeg','max:512']"
                                        :multiple="false"
                                        :key="'logo-three'" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2" wire:ignore.self>
                            <div class="col-12">
                                <label for="initialAlamat" class="input-group-text">Alamat</label>
                                <livewire:jodit-text-editor 
                                    wire:key="{{ uniqid() }}"
                                    joditId="{{ uniqid() }}"
                                    wire:model="form.initialAlamat"
                                    value="{!! $this->form->initialAlamat !!}"
                                    />
                            </div>
                        </div>
                        <div class="row mb-2" wire:ignore.self>
                            <div class="col-12">
                                <label for="initialMotto" class="input-group-text">Motto</label>
                                <livewire:jodit-text-editor 
                                    wire:key="{{ uniqid() }}"
                                    joditId="{{ uniqid() }}"
                                    wire:model="form.initialMotto"
                                    value="{!! $this->form->initialMotto !!}"
                                    />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa-solid fa-floppy-disk"></i> simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>
