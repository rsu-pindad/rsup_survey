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
                            <form wire:submit="save">
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
                                    <input 
                                        value="{{ $this->form->unitMainLogo }}"
                                        wire:model="form.unitMainLogo"
                                        type="text" 
                                        class="form-control" 
                                        id="unitMainLogo" 
                                        aria-describedby="unitMainLogoHelp">
                                </div>
                                <div class="mb-2">
                                    <label for="unitSubLogo" class="form-label">Sub Logo</label>
                                    <input 
                                        value="{{ $this->form->unitSubLogo }}"
                                        wire:model="form.unitSubLogo"
                                        type="text" 
                                        class="form-control" 
                                        id="unitSubLogo" 
                                        aria-describedby="unitSubLogoHelp">
                                </div>
                                <div class="mb-2" wire:ignore.self>
                                    <label for="unitAlamat" class="form-label">Alamat</label>
                                    @livewire('livewire-quill', [
                                        'quillId' => 'quillAlamat',
                                        'data' => $this->form->unitAlamat,
                                        'classes' => 'bg-white',
                                        'toolbar' => [
                                            [
                                                [
                                                    'header' => [6],
                                                ],
                                            ],
                                            ['bold', 'italic', 'underline'],
                                            [
                                                [
                                                    'list' => 'ordered',
                                                ],
                                                [
                                                    'list' => 'bullet',
                                                ],
                                            ],
                                        ],
                                    ])
                                </div>
                                <div class="mb-2">
                                    <label for="unitMotto" class="form-label">Motto</label>
                                    <input 
                                        value="{{ $this->form->unitMotto }}"
                                        wire:model="form.unitMotto"
                                        type="text" 
                                        class="form-control" 
                                        id="unitMotto" 
                                        aria-describedby="unitMottoHelp">
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
