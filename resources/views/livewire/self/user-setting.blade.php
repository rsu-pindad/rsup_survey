<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="row mb-3">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile</h4>
                        </div>
                        <div class="card-body m-2">
                            <div class="row mb-3">
                                <form wire:submit="editUser">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input 
                                                    wire:model.defer="profileForm.userEmail"
                                                    value="{{ $this->profileForm->userEmail }}"
                                                    type="email" 
                                                    class="form-control" 
                                                    id="userEmail" 
                                                    aria-describedby="userEmailHelp">
                                                <label for="userEmail" class="form-label">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <form wire:submit="edit">
                                    <div class="row mb-2">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-floating">
                                                <input 
                                                    wire:model.defer="profileForm.nppKaryawan"
                                                    value="{{ $this->profileForm->nppKaryawan }}"
                                                    type="text" 
                                                    class="form-control" 
                                                    id="userNpp" 
                                                    aria-describedby="userNppHelp"
                                                    disabled
                                                    readonly>
                                                <label for="userNpp" class="form-label">Npp</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-floating">
                                                <input 
                                                    wire:model.defer="profileForm.unitKaryawan"
                                                    value="{{ $this->profileForm->unitKaryawan }}"
                                                    type="text" 
                                                    class="form-control" 
                                                    id="userUnit" 
                                                    aria-describedby="userUnitHelp"
                                                    disabled
                                                    readonly>
                                                <label for="userUnit" class="form-label">Unit</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-floating">
                                                <input 
                                                    wire:model.defer="profileForm.layananKaryawan"
                                                    value="{{ $this->profileForm->layananKaryawan }}"
                                                    type="text" 
                                                    class="form-control" 
                                                    id="userLayanan" 
                                                    aria-describedby="userLayananHelp"
                                                    disabled
                                                    readonly>
                                                <label for="userLayanan" class="form-label">Layanan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-floating">
                                                <input 
                                                    wire:model.defer="profileForm.namaKaryawan"
                                                    value="{{ $this->profileForm->namaKaryawan }}"
                                                    type="text" 
                                                    class="form-control" 
                                                    id="userNama" 
                                                    aria-describedby="userNamaHelp">
                                                    <label for="userNama" class="form-label">Nama</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-floppy-disk"></i>
                                            </button> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
