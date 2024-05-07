<div>
    <form wire:submit="save">
        <div class="mb-2">
            <label for="namaRespon" class="form-label">Nama Respon</label>
            <input wire:model="form.namaRespon" 
                type="text" 
                class="form-control" 
                id="namaRespon" 
                aria-describedby="namaResponHelp"
                placeholder="masukan nama respon">
            <div id="namaResponHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-2">
            <label for="iconRespon" class="form-label">Icon Respon</label>
            <input wire:model="form.iconRespon" 
                type="text" 
                class="form-control" 
                id="iconRespon" 
                aria-describedby="iconResponHelp"
                placeholder="masukan icon respon">
            <div id="iconResponHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-2">
            <label for="tagWarnaRespon" class="form-label">Icon Respon</label>
            <input wire:model="form.tagWarnaRespon" 
                type="color" 
                class="form-control form-control-color" 
                id="tagWarnaRespon" 
                aria-describedby="tagWarnaResponHelp"
                placeholder="masukan icon respon">
            <div id="tagWarnaResponHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-2">
            <label for="skorRespon" class="form-label">Skor Respon</label>
            <input wire:model="form.skorRespon" 
                type="number" 
                class="form-control" 
                id="skorRespon" 
                aria-describedby="skorResponHelp"
                placeholder="masukan skor respon">
            <div id="skorResponHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-2">
            <label for="urutanRespon" class="form-label">Urutan Respon</label>
            <input wire:model="form.urutanRespon" 
                type="number" 
                class="form-control" 
                id="urutanRespon" 
                aria-describedby="urutanResponHelp"
                placeholder="masukan urutan respon">
            <div id="urutanResponHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button> 
    </form>
</div>
