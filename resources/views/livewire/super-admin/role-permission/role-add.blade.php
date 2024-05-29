<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.namaRole" 
                            type="text" 
                            class="form-control" 
                            id="namaRole" 
                            aria-describedby="namaRoleHelp"
                            placeholder="masukan nama role">
                            <label for="namaRole" class="form-label">Nama Role</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.namaRole') <span class="error">{{ $message }}</span> @enderror
                    </div>
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
