<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Unit</h4>
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
                                    <label for="unitMainLogo" class="form-label">Main Logo</label>
                                    <livewire:dropzone
                                            wire:model.defer="mainLogo"
                                            :rules="['image','mimes:png,jpeg,webp','max:10420']"
                                            :multiple="false"
                                            :key="'logo-one'" />
                                </div>
                                <div class="mb-2">
                                    <label for="unitSubLogo" class="form-label">Sub Logo</label>
                                        <livewire:dropzone
                                            wire:model.defer="subLogo"
                                            :rules="['image','mimes:png,jpeg,webp','max:10420']"
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
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</div>
