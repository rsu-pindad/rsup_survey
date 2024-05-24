<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.namaPermisi" 
                            type="text" 
                            class="form-control" 
                            id="namaPermisi" 
                            aria-describedby="namaPermisiHelp"
                            placeholder="masukan nama permisi">
                        <label for="namaPermisi" class="form-label">Nama Permisi</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('namaPermisi') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                </button>
            </div>
        </div>
    </form>
</div>
