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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.namaPenjamin')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model="form.namaPenjamin"
                                            type="text" 
                                            @error('form.namaPenjamin')
                                            class="form-control is-invalid" 
                                            @else
                                            class="form-control" 
                                            @enderror
                                            id="namaPenjamin" 
                                            value="{{ $this->form->namaPenjamin }}">
                                        <label for="namaPenjamin" class="form-label">Nama Penjamin</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.namaPenjamin') <span class="error">{{ $message }}</span> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="align-self-center p-2">
                                <a wire:navigate
                                    href="{{ route('root-penjamin') }}"
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
