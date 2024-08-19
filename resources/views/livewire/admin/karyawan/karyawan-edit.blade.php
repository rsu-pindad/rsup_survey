<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div class="form-floating is-invalid">
                                        <input 
                                            wire:model.defer="form.nppKaryawan"
                                            type="text" 
                                            class="form-control" 
                                            id="nppKaryawan" 
                                            value="{{ $this->form->nppKaryawan }}">
                                        <label for="nppKaryawan" class="form-label">Npp Karyawan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-check">
                                    <input 
                                        wire:model="form.activeKaryawan" 
                                        class="form-check-input" type="checkbox" value="{{ $this->form->activeKaryawan }}" checked>
                                    <label class="form-check-label" for="activeKaryawan">aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="align-self-center p-2">
                                <a wire:navigate
                                    href="{{ route('root-karyawan') }}"
                                    class="btn btn-secondary">
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
