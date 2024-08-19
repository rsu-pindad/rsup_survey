<div>
    <form wire:submit="save">
        <div class="row mb-2">
            <div class="col-12">
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
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <div class="form-check">
                    <input 
                        wire:model="form.multiPenilaian" 
                        id="multiPenilaian"
                        class="form-check-input" 
                        type="checkbox" 
                        checked>
                    <label class="form-check-label" for="multiPenilaian">
                        multi penilaian
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
