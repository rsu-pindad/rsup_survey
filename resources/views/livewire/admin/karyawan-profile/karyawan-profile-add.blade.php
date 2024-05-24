<div>
    <form wire:submit="save">
        <div class="row mb-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                        id="emailUser"
                        wire:model="form.idUser"
                        class="form-select" aria-label="select-respon">
                        <option hidden selected>pilih</option>
                        @forelse ($user as $u)
                        <option value="{{ $u->id }}">{{ $u->email }}</option>
                        @empty
                        <option disabled>Maaf user tidak ditemukan</option>
                        @endforelse
                    </select>
                    <label for="emailUser">Pilih email user</label>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                    id="nppKaryawan"
                    wire:model="form.idKaryawan"
                    class="form-select" aria-label="select-respon">
                    <option hidden selected>pilih</option>
                    @forelse ($karyawan as $k)
                    <option value="{{ $k->id }}">{{ $k->npp_karyawan }}</option>
                    @empty
                    <option disabled>Maaf npp karyawan tidak ditemukan</option>
                    @endforelse
                </select>
                <label for="nppKaryawan">Pilih Npp Karyawan</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                        id="namaUnit"
                        wire:model="form.idUnit"
                        class="form-select" aria-label="select-respon">
                        <option hidden selected>pilih</option>
                        @forelse ($unit as $u)
                        <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                        @empty
                        <option disabled>Maaf unit tidak ditemukan</option>
                        @endforelse
                    </select>
                    <label for="namaUnit" class="form-label">Pilih Unit</label>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                        id="namaLayanan"
                        wire:model="form.idLayanan"
                        class="form-select" aria-label="select-respon">
                        <option hidden selected>pilih</option>
                        @forelse ($layanan as $l)
                        <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                        @empty
                        <option disabled>Maaf layanan tidak ditemukan</option>
                        @endforelse
                    </select>
                    <label for="namaLayanan" class="form-label">Pilih Layanan</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.namaKaryawan" 
                            type="text" 
                            class="form-control" 
                            id="namaKaryawan" 
                            aria-describedby="namaKaryawanHelp"
                            placeholder="masukan nama karyawan">
                        <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                        <div id="namaKaryawanHelp" class="invalid-feedback">
                            @error('content') <span class="error">{{ $message }}</span> @enderror 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
