<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="namaRole" class="form-label">Nama Role</label>
            <input wire:model="form.namaRole" 
                type="text" 
                class="form-control" 
                id="namaRole" 
                aria-describedby="namaRoleHelp"
                placeholder="masukan nama role">
            <div id="namaRoleHelp" class="form-text">
                @error('namaRole') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>        
    </form>
</div>
