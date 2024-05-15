<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="namaPermisi" class="form-label">Nama Permisi</label>
            <input wire:model="form.namaPermisi" 
                type="text" 
                class="form-control" 
                id="namaPermisi" 
                aria-describedby="namaPermisiHelp"
                placeholder="masukan nama permisi">
            <div id="namaPermisiHelp" class="form-text">
                @error('namaPermisi') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>        
    </form>
</div>
