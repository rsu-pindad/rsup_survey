<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5 my-5">
        <div class="rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-3 row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.namaRespon')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model.defer="form.namaRespon"
                                            type="text" 
                                            @error('form.namaRespon')
                                            class="form-control is-invalid"
                                            @else
                                            class="form-control"
                                            @enderror
                                            id="namaRespon" 
                                            value="{{ $this->form->namaRespon }}">
                                        <label for="namaRespon" class="form-label">Nama Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.namaRespon') 
                                        <span class="error">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.iconRespon')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model.defer="form.iconRespon"
                                            type="text" 
                                            @error('form.iconRespon')
                                            class="form-control is-invalid" 
                                            @else
                                            class="form-control" 
                                            @enderror
                                            id="iconRespon" 
                                            value="{{ $this->form->iconRespon }}">
                                        <label for="iconRespon" class="form-label">Icon Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.iconRespon') 
                                        <span class="error">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.skorRespon')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model.defer="form.skorRespon"
                                            type="number" 
                                            @error('form.skorRespon')
                                            class="form-control is-invalid" 
                                            @else
                                            class="form-control" 
                                            @enderror
                                            id="skorRespon" 
                                            value="{{ $this->form->skorRespon }}">
                                        <label for="skorRespon" class="form-label">Skor Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.skorRespon') 
                                        <span class="error">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.urutanRespon')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model.defer="form.urutanRespon"
                                            type="number" 
                                            @error('form.urutanRespon')
                                            class="form-control is-invalid" 
                                            @else
                                            class="form-control" 
                                            @enderror
                                            id="urutanRespon" 
                                            value="{{ $this->form->urutanRespon }}">
                                        <label for="urutanRespon" class="form-label">Urutan Respon</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.urutanRespon') 
                                        <span class="error">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group has-validation flex-nowrap">
                                    <span class="input-group-text">#</span>
                                    <input 
                                        wire:model.defer="form.tagWarnaRespon"
                                        type="color" 
                                        id="tagWarnaRespon" 
                                        @error('tagWarnaRespon')
                                        class="form-control form-control-color is-invalid" 
                                        @else
                                        class="form-control form-control-color" 
                                        @enderror
                                        value="{{ $this->form->tagWarnaRespon }}">
                                </div>
                                @error('form.tagWarnaRespon') <span class="text-danger">{{ $message }}</span> @enderror 
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
