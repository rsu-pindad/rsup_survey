<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5 my-5">
        <div class="rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="row mb-2">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.idPenjamin')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <select 
                                            id="selectPenjamin"
                                            wire:model="form.idPenjamin"
                                            @error('form.idPenjamin')
                                            class="form-select is-invalid" 
                                            @else
                                            class="form-select" 
                                            @enderror
                                            aria-label="select-penjamin">
                                            @forelse ($penjamin as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_penjamin }}</option>
                                            @empty
                                            <option disabled>Maaf penjamin tidak ditemukan</option>
                                            @endforelse
                                        </select>
                                        <label for="selectPenjamin">Pilih penjamin</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.idPenjamin') <span class="error">{{ $message }}</span> @enderror 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="input-group has-validation">
                                    <div 
                                        @error('form.idLayanan')
                                        class="form-floating is-invalid"
                                        @else
                                        class="form-floating"
                                        @enderror
                                        >
                                        <select 
                                            id="selectLayanan"
                                            wire:model="form.idLayanan"
                                            @error('form.idLayanan')
                                            class="form-select is-invalid" 
                                            @else
                                            class="form-select"
                                            @enderror
                                            aria-label="select-layanan">
                                            @forelse ($layanan as $l)
                                            <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                                            @empty
                                            <option disabled>Maaf layanan tidak ditemukan</option>
                                            @endforelse
                                        </select>
                                        <label for="selectLayanan">Pilih layanan</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('form.idPenjamin') <span class="error">{{ $message }}</span> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex flex-row justify-content-center flex-wrap">
                                <div class="align-self-center p-2">
                                    <a wire:navigate
                                        href="{{ route('root-penjamin-layanan') }}"
                                        class="btn btn-secondary">
                                        <i class="fa-solid fa-arrow-left-long"></i> kembali
                                    </a>
                                </div>
                                <div class="align-self-center p-2">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fa-solid fa-floppy-disk"></i> perbarui
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>
