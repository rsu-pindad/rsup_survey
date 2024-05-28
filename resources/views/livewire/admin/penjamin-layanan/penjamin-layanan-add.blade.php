<div>
    <form wire:submit="save">
        <div class="row mb-3">
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
                            <option hidden selected>pilih penjamin</option>
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
                            ria-label="select-layanan">
                            <option hidden selected>pilih layanan</option>
                            @forelse ($layanan as $l)
                            <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                            @empty
                            <option disabled>Maaf layanan tidak ditemukan</option>
                            @endforelse
                        </select>
                        <label for="selectLayanan">Pilih layanan</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.idLayanan') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
