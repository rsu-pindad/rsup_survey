<div>
    <form  
        wire:submit="preStore">
            <div class="form-floating">
                <div>
                    @error('form.email') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                </div>
                <input 
                wire:model.defer="form.email"
                wire:ignore.self
                type="email" 
                class="form-control" 
                placeholder="masukan email">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <div>
                    @error('form.password') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                </div>
                <input 
                wire:model.defer="form.password"
                wire:ignore.self
                type="password" class="form-control" id="floatingPassword" placeholder="masukan password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <div>
                    @error('form.idUnit') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                </div>
                <select
                    wire:model.defer="form.idUnit"
                    wire:ignore.self
                    id="idUnit" 
                    class="form-select" 
                    aria-label="select-unit">
                    <option hidden selected>pilih unit</option>
                    @forelse ($unit as $u)
                    <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                    @empty
                    <option disabled>Maaf unit tidak ditemukan</option>
                    @endforelse
                  </select>
            </div>
            <div class="form-floating mb-3">
                <div>
                    @error('form.idLayanan') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                </div>
                <select 
                    wire:model.defer="form.idLayanan"
                    wire:ignore.self
                    id="idLayanan"
                    class="form-select" 
                    aria-label="select-layanan">
                    <option hidden selected>pilih layanan</option>
                    @forelse ($layanan as $l)
                    <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                    @empty
                    <option disabled>Maaf layanan tidak ditemukan</option>
                    @endforelse
                  </select>
            </div>
            <div class="form-floating mb-3">
                <div>
                    @error('form.namaKaryawan') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror
                </div>
                <input 
                wire:model.defer="form.namaKaryawan"
                wire:ignore.self
                type="text" 
                class="form-control" 
                placeholder="masukan npp">
                <label for="floatingInput">Nama Karyawan</label>
            </div>
            <div class="container-fluid">
                <div class="d-flex flex-column justify-content-center">
                    <div class="align-self-center p-2">
                        <button 
                            wire:loading.attr="disabled"
                            wire:loading.remove
                            class="btn btn-primary w-100 py-2" 
                            type="submit">Daftar</button>
                    </div>
                    <div class="align-self-center p-2">
                            <i wire:loading 
                            class="fa-solid fa-spinner"></i>
                    </div>
                    <div class="align-self-center p-2">
                        <p class="mt-5 mb-3 text-body-secondary text-uppercase">©2024 Rsu Pindad</p>
                    </div>
                </div>
            </div>
        </form>
</div>
