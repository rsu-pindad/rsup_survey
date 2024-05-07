<div>
    <form wire:submit="save">
        <div class="mb-3">
            <label for="nppKaryawan" class="form-label">Npp Karyawan</label>
            <input wire:model="form.nppKaryawan" 
                type="number" 
                class="form-control" 
                id="nppKaryawan" 
                aria-describedby="nppKaryawanHelp"
                placeholder="masukan npp layanan">
            <div id="nppKaryawanHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input 
                    wire:model="form.activeKaryawan" 
                    class="form-check-input" type="checkbox" checked>
                <label class="form-check-label" for="activeKaryawan">
                  aktif
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
