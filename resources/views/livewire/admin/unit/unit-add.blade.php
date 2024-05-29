<div>
    <form wire:submit="save">
        <div class="mb-3">
            <div class="input-group has-validation">
                <div 
                    @error('form.namaUnit')
                    class="form-floating is-invalid"
                    @else
                    class="form-floating"
                    @enderror
                    >
                    <input wire:model="form.namaUnit" 
                        type="text" 
                        @error('form.namaUnit')
                        class="form-control is-invalid" 
                        @else
                        class="form-control" 
                        @enderror
                        id="namaUnit" 
                        aria-describedby="namaUnitHelp"
                        placeholder="masukan nama unit">
                    <label for="namaUnit">Nama Unit</label>
                </div>
                <div class="invalid-feedback">
                    @error('form.namaUnit') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> simpan
            </button>
        </div>
    </form>
</div>
