<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Unit</h4>
                            <a 
                                class="btn btn-outline-secondary btn-sm"
                                href="{{ route('root-unit') }}" 
                                wire:navigate="true">
                                <i class="fa-solid fa-arrow-left-long"></i>
                            </a>
                        </div>
                        <div class="card-body m-2">
                            <form wire:submit="save" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="unitNama" class="form-label">Nama Unit</label>
                                    <input 
                                        value="{{ $this->form->unitNama }}"
                                        type="text" 
                                        class="form-control" 
                                        id="unitNama" 
                                        aria-describedby="unitNamaHelp"
                                        readonly
                                        disabled>
                                </div>
                                <div class="mb-2">
                                    <div class="card" style="width: 12rem;">
                                        <img 
                                        class="img-thumbnail rounded"
                                        src="{{ basset('photos/'.$this->form->unitMainLogoOld ?? 'default.png') }}" 
                                        alt="current_logo_main">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="unitMainLogo" class="form-label">Main Logo</label>
                                    <livewire:dropzone
                                        wire:model="mainLogo"
                                        :rules="['image','mimes:png,jpeg,webp','max:1024']"
                                        :multiple="false"
                                        :key="'logo-one'" />
                                </div>
                                <div class="mb-2">
                                    <div class="card" style="width: 12rem;">
                                        <img 
                                        class="img-thumbnail rounded"
                                        src="{{ basset('photos/'.$this->form->unitSubLogoOld ?? 'default.png') }}" 
                                        alt="current_logo_sub">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="unitSubLogo" class="form-label">Sub Logo</label>
                                    <livewire:dropzone
                                        wire:model="subLogo"
                                        :rules="['image','mimes:png,jpeg','max:512']"
                                        :multiple="false"
                                        :key="'logo-two'" />
                                </div>
                                <div class="mb-2">
                                    <label for="unitAlamat" class="form-label">Alamat</label>
                                    <livewire:jodit-text-editor 
                                        wire:model="form.unitAlamat"
                                        value="{{ $this->form->unitAlamat }}" />
                                </div>
                                <div class="mb-2">
                                    <label for="unitMotto" class="form-label">Motto</label>
                                    <livewire:jodit-text-editor 
                                        wire:model="form.unitMotto"
                                        value="{{ $this->form->unitMotto }}" />
                                </div>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <livewire:admin.unit.unit-profil.unit-profil-preview 
                        :unitProfil="$id" 
                        :unitName="$this->form->unitNama"
                        />
                </div>
            </div>
        </div>
    </main>
    
</div>
