<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div 
                        @error('form.namaLayanan')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="form.namaLayanan" 
                            type="text" 
                            @error('form.namaLayanan')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="namaLayanan" 
                            aria-describedby="namaLayananHelp"
                            placeholder="masukan nama layanan">
                            <label for="namaLayanan">Nama Layanan</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.namaLayanan') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <div class="form-check">
                    <input 
                        wire:model="form.multiLayanan" 
                        id="multiLayanan"
                        class="form-check-input" 
                        type="checkbox" 
                        checked>
                    <label class="form-check-label" for="multiLayanan">
                        multi layanan
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
