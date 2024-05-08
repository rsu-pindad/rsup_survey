<div>
    <form wire:submit="change">
        <div class="mb-3">
            <label for="oldPassword" class="form-label">Password Lama</label>
            @error('form.oldPassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
            <input 
                wire:model.defer="form.oldPassword"
                placeholder="masukan password lama"
                type="password" 
                class="form-control" 
                id="oldPassword">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            @error('form.newPassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
            <input 
                wire:model.defer="form.newPassword"
                placeholder="masukan password baru"
                type="password" 
                class="form-control" 
                id="password">
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Ulangi Password Baru</label>
            @error('form.reTypePassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
            <input 
                wire:model.defer="form.reTypePassword"
                placeholder="ulangi password baru"
                type="password" 
                class="form-control" 
                id="confirmPassword">
        </div>
        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </form>
</div>
