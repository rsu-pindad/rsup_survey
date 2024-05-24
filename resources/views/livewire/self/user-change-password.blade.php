<div>
    <form wire:submit="change">
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input 
                        wire:model.defer="form.oldPassword"
                        placeholder="masukan password lama"
                        type="password" 
                        class="form-control" 
                        id="oldPassword">
                        <label for="oldPassword" class="form-label">Password Lama</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.oldPassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input 
                            wire:model.defer="form.newPassword"
                            placeholder="masukan password baru"
                            type="password" 
                            class="form-control" 
                            id="password">
                        <label for="password" class="form-label">Password Baru</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.newPassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input 
                            wire:model.defer="form.reTypePassword"
                            placeholder="ulangi password baru"
                            type="password" 
                            class="form-control" 
                            id="confirmPassword">
                        <label for="confirmPassword" class="form-label">Ulangi Password Baru</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.reTypePassword') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </div>
        </div>
    </form>
</div>
