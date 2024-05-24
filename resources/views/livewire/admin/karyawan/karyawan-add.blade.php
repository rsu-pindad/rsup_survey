<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.nppKaryawan" 
                            type="text" 
                            class="form-control" 
                            id="nppKaryawan" 
                            aria-describedby="nppKaryawanHelp"
                            placeholder="masukan npp layanan">
                        <label for="nppKaryawan" class="form-label">Masukan Npp Karyawan</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('content') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-check">
                    <input 
                        wire:model="form.activeKaryawan" 
                        class="form-check-input" 
                        type="checkbox" 
                        checked>
                    <label class="form-check-label" for="activeKaryawan">
                    aktif
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
