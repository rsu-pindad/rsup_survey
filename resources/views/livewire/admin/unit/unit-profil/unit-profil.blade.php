<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid px-5 my-5">
        <div class="rounded">
            <div class="row mb-3">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <livewire:admin.unit.unit-profil.unit-profil-preview 
                        :unitProfil="$id" 
                        :unitName="$this->form->unitNama"
                        />
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Unit</h4>
                            <a wire:navigate
                                class="btn btn-outline-secondary btn-sm"
                                href="{{ route('root-unit') }}" 
                                >
                                <i class="fa-solid fa-arrow-left-long"></i> kembali
                            </a>
                        </div>
                        <div class="card-body m-2">
                            <form wire:submit="save" enctype="multipart/form-data">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <div class="form-floating">
                                                <input 
                                                    type="text" 
                                                    id="unitNama" 
                                                    class="form-control" 
                                                    value="{{ $this->form->unitNama }}"
                                                    aria-describedby="unitNamaHelp"
                                                    readonly
                                                    disabled >
                                                <label for="unitNama" class="form-label">Nama Unit</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex flex-row align-items-center mb-2">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                        <div class="card" style="width: 12rem;">
                                            <img 
                                                class="img-thumbnail rounded"
                                                @if(env('APP_ENV') == 'local')
                                                src="{{ asset('storage/basset/photos/'.$this->form->unitMainLogoOld ?? 'defaultmain.png') }}" 
                                                @else
                                                src="{{ asset('public/photos/'.$this->form->unitMainLogoOld ?? 'defaultmain.png') }}"
                                                @endif
                                                alt="current_logo_main">
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12">
                                        <div class="input-group">
                                            <label for="unitMainLogo" class="input-group-text">Main Logo</label>
                                            <livewire:dropzone
                                                wire:model="form.unitMainLogo"
                                                :rules="['image','mimes:png,jpeg,webp','max:1024']"
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
                                                @if(env('APP_ENV') == 'local')
                                                src="{{ asset('storage/basset/photos/'.$this->form->unitSubLogoOld ?? 'default.png') }}" 
                                                @else
                                                src="{{ asset('public/photos/'.$this->form->unitSubLogoOld ?? 'defaultsub.png') }}"
                                                @endif
                                                alt="current_logo_sub">
                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12">
                                        <div class="input-group">
                                            <label for="unitSubLogo" class="input-group-text">Sub Logo</label>
                                            <livewire:dropzone
                                                wire:model="form.unitSubLogo"
                                                :rules="['image','mimes:png,jpeg','max:512']"
                                                :multiple="false"
                                                :key="'logo-two'" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2" wire:ignore>
                                    <div class="col-12">
                                        <label for="unitAlamat" class="input-group-text">Alamat</label>
                                        <livewire:jodit-text-editor 
                                            wire:model="form.unitAlamat"
                                            value="{{ $this->form->unitAlamat }}"
                                            />
                                    </div>
                                </div>
                                <div class="row mb-2" wire:ignore>
                                    <div class="col-12">
                                        <label for="unitMotto" class="input-group-text">Motto</label>
                                        <livewire:jodit-text-editor 
                                            wire:model="form.unitMotto"
                                            value="{{ $this->form->unitMotto }}"
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
            </div>
        </div>
    </main>
    
</div>
