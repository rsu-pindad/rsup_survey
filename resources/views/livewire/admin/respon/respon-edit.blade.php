<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-3 row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input 
                                            wire:model.defer="form.namaRespon"
                                            type="text" 
                                            class="form-control" 
                                            id="namaRespon" 
                                            value="{{ $this->form->namaRespon }}">
                                        <label for="namaRespon" class="form-label">Nama Respon</label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input 
                                            wire:model.defer="form.iconRespon"
                                            type="text" 
                                            class="form-control" 
                                            id="iconRespon" 
                                            value="{{ $this->form->iconRespon }}">
                                        <label for="iconRespon" class="form-label">Icon Respon</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input 
                                            wire:model.defer="form.skorRespon"
                                            type="number" 
                                            class="form-control" 
                                            id="skorRespon" 
                                            value="{{ $this->form->skorRespon }}">
                                        <label for="skorRespon" class="form-label">Skor Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input 
                                            wire:model.defer="form.urutanRespon"
                                            type="number" 
                                            class="form-control" 
                                            id="urutanRespon" 
                                            value="{{ $this->form->urutanRespon }}">
                                        <label for="urutanRespon" class="form-label">Urutan Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text">#</span>
                                    <input 
                                        wire:model.defer="form.tagWarnaRespon"
                                        type="color" 
                                        class="form-control form-control-color" 
                                        id="tagWarnaRespon" 
                                        value="{{ $this->form->tagWarnaRespon }}">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center flex-wrap">
                            <div class="align-self-center p-2">
                                <a wire:navigate
                                    href="{{ route('root-respon') }}"
                                    class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-arrow-left-long"></i> kembali
                                </a>
                            </div>
                            <div class="align-self-center p-2">
                                <button
                                    class="btn btn-outline-primary"
                                    type="submit">
                                    <i class="fa-solid fa-floppy-disk"></i> perbarui
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>
