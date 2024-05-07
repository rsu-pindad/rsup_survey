<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="namaPenjamin" class="form-label">Nama Penjamin</label>
            <input wire:model="form.namaPenjamin" 
                type="text" 
                class="form-control" 
                id="namaPenjamin" 
                aria-describedby="namaPenjaminHelp"
                placeholder="masukan nama penjamin">
            <div id="namaPenjaminHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button> 
    </form>
</div>
