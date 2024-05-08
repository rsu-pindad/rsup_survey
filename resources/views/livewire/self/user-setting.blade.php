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
                            <h4>Profile</h4>
                        </div>
                        <div class="card-body m-2">
                            <div class="mb-2">
                                <form wire:submit="editUser">
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email</label>
                                        <input 
                                            wire:model.defer="profileForm.userEmail"
                                            value="{{ $this->profileForm->userEmail }}"
                                            type="email" 
                                            class="form-control" 
                                            id="userEmail" 
                                            aria-describedby="userEmailHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah Email</button>                                
                                </form>
                            </div>
                            <div class="mb-2">
                                <form wire:submit="edit">
                                    <div class="mb-3">
                                        <label for="userNpp" class="form-label">Npp</label>
                                        <input 
                                            wire:model.defer="profileForm.nppKaryawan"
                                            value="{{ $this->profileForm->nppKaryawan }}"
                                            type="text" 
                                            class="form-control" 
                                            id="userNpp" 
                                            aria-describedby="userNppHelp"
                                            disabled
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userUnit" class="form-label">Unit</label>
                                        <input 
                                            wire:model.defer="profileForm.unitKaryawan"
                                            value="{{ $this->profileForm->unitKaryawan }}"
                                            type="text" 
                                            class="form-control" 
                                            id="userUnit" 
                                            aria-describedby="userUnitHelp"
                                            disabled
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userLayanan" class="form-label">Layanan</label>
                                        <input 
                                            wire:model.defer="profileForm.layananKaryawan"
                                            value="{{ $this->profileForm->layananKaryawan }}"
                                            type="text" 
                                            class="form-control" 
                                            id="userLayanan" 
                                            aria-describedby="userLayananHelp"
                                            disabled
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userNama" class="form-label">Nama</label>
                                        <input 
                                            wire:model.defer="profileForm.namaKaryawan"
                                            value="{{ $this->profileForm->namaKaryawan }}"
                                            type="text" 
                                            class="form-control" 
                                            id="userNama" 
                                            aria-describedby="userNamaHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <livewire:self.user-change-password/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
