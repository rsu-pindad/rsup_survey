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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.namaLayanan')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <input 
                                            wire:model.defer="form.namaLayanan"
                                            type="text" 
                                            @error('form.namaLayanan')
                                            class="form-control is-invalid" 
                                            @else
                                            class="form-control" 
                                            @enderror
                                            id="namaLayanan" 
                                            value="{{ $this->form->namaLayanan }}">
                                        <label for="namaLayanan" class="form-label">Nama Layanan</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.namaLayanan') <span class="error">{{ $message }}</span> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input 
                                        wire:model="form.multiLayanan" 
                                        id="multiLayanan"
                                        class="form-check-input" 
                                        type="checkbox"
                                        @if($this->form->multiLayanan == true) 
                                        checked
                                        @endif
                                        >
                                    <label class="form-check-label" for="multiLayanan">
                                        multi layanan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center flex-wrap">
                            <div class="align-self-center p-2">
                                <a wire:navigate
                                    href="{{ route('root-layanan') }}"
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
