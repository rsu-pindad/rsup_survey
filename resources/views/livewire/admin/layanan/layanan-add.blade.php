<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="namaLayanan" class="form-label">Nama Layanan</label>
            <input wire:model="form.namaLayanan" 
                type="text" 
                class="form-control" 
                id="namaLayanan" 
                aria-describedby="namaLayananHelp"
                placeholder="masukan nama layanan">
            <div id="namaLayananHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>        
    </form>
</div>
