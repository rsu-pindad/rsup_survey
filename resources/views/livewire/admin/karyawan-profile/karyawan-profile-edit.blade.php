<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Karyawan Profile</h4>
                </div>
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-2 row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-floating">
                                    <select 
                                        wire:model="form.idUnit"
                                        class="form-select" aria-label="select-unit" id="namaUnit">
                                        @forelse ($unit as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                                        @empty
                                        <option disabled>Maaf unit tidak ditemukan</option>
                                        @endforelse
                                    </select>
                                    <label for="namaUnit">Pilih Unit</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-floating">
                                    <select 
                                        wire:model="form.idKaryawan"
                                        class="form-select" aria-label="select-karyawan" id="nppKaryawan">
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
                        <div class="mb-2 row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-floating">
                                    <select 
                                        wire:model="form.idLayanan"
                                        class="form-select" aria-label="select-layanan" id="namaLayanan">
                                        @forelse ($layanan as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                                        @empty
                                        <option disabled>Maaf layanan tidak ditemukan</option>
                                        @endforelse
                                    </select>
                                    <label for="namaLayanan">Pilih Layanan</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-floating">
                                    <input wire:model="form.namaKaryawan" 
                                        type="text" 
                                        class="form-control" 
                                        id="namaKaryawan" 
                                        aria-describedby="namaKaryawanHelp"
                                        placeholder="masukan nama karyawan"
                                        value="{{ $this->form->namaKaryawan }}">
                                    <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                                    <div id="namaKaryawanHelp" class="form-text">
                                        @error('content') <span class="error">{{ $message }}</span> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row">
                        </div>
                        <div class="mb-2 row">
                            <div class="d-flex flex-row justify-content-center flex-wrap">
                                <div class="align-self-center p-2">
                                    <a wire:navigate
                                        href="{{ route('root-karyawan-profile') }}"
                                        class="btn btn-secondary">
                                        <i class="fa-solid fa-arrow-left-long"></i> kembali
                                    </a>
                                </div>
                                <div class="align-self-center p-2">
                                    <button
                                        class="btn btn-outline-primary"
                                        type="submit">
                                        <i class="fa-solid fa-floppy-disk"></i> perbarui
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
