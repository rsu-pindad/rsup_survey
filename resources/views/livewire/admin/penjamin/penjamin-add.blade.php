<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <div 
                            @error('form.namaPenjamin')
                            class="form-floating is-invalid"
                            @else
                            class="form-floating"
                            @enderror
                            >
                            <input wire:model="form.namaPenjamin" 
                                type="text" 
                                @error('form.namaPenjamin')
                                class="form-control is-invalid" 
                                @else
                                class="form-control" 
                                @enderror
                                id="namaPenjamin" 
                                aria-describedby="namaPenjaminHelp"
                                placeholder="masukan nama penjamin">
                            <label for="namaPenjamin">Nama Penjamin</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('form.namaPenjamin') <span class="error">{{ $message }}</span> @enderror 
                        </div>
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
