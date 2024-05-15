<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="namaUnit" class="form-label">Nama Unit</label>
            <input wire:model="form.namaUnit" 
                type="text" 
                class="form-control" 
                id="namaUnit" 
                aria-describedby="namaUnitHelp"
                placeholder="masukan nama unit">
            <div id="namaUnitHelp" class="form-text">
                @error('namaUnit') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>        
    </form>
</div>
