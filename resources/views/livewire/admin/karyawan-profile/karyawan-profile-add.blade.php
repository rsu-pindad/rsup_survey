<div>
    <form wire:submit="save">
        <div class="mb-2">
            <label for="emailUser" class="form-label">Pilih email user</label>
            <select 
                id="emailUser"
                wire:model="form.idUser"
                class="form-select" aria-label="select-respon">
                <option hidden selected>pilih email user</option>
                @forelse ($user as $u)
                <option value="{{ $u->id }}">{{ $u->email }}</option>
                @empty
                <option disabled>Maaf user tidak ditemukan</option>
                @endforelse
            </select>
        </div>
        <div class="mb-2">
            <label for="nppKaryawan" class="form-label">Pilih Npp Karyawan</label>
            <select 
                id="nppKaryawan"
                wire:model="form.idKaryawan"
                class="form-select" aria-label="select-respon">
                <option hidden selected>pilih npp karyawan</option>
                @forelse ($karyawan as $k)
                <option value="{{ $k->id }}">{{ $k->npp_karyawan }}</option>
                @empty
                <option disabled>Maaf npp karyawan tidak ditemukan</option>
                @endforelse
            </select>
        </div>
        <div class="mb-2">
            <label for="namaUnit" class="form-label">Pilih Unit</label>
            <select 
                id="namaUnit"
                wire:model="form.idUnit"
                class="form-select" aria-label="select-respon">
                <option hidden selected>pilih unit</option>
                @forelse ($unit as $u)
                <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                @empty
                <option disabled>Maaf unit tidak ditemukan</option>
                @endforelse
            </select>
        </div>
        <div class="mb-2">
            <label for="namaLayanan" class="form-label">Pilih Layanan</label>
            <select 
                id="namaLayanan"
                wire:model="form.idLayanan"
                class="form-select" aria-label="select-respon">
                <option hidden selected>pilih layanan</option>
                @forelse ($layanan as $l)
                <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                @empty
                <option disabled>Maaf layanan tidak ditemukan</option>
                @endforelse
            </select>
        </div>
        <div class="mb-2">
            <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
            <input wire:model="form.namaKaryawan" 
                type="text" 
                class="form-control" 
                id="namaKaryawan" 
                aria-describedby="namaKaryawanHelp"
                placeholder="masukan nama karyawan">
            <div id="namaKaryawanHelp" class="form-text">
                @error('content') <span class="error">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
</div>
