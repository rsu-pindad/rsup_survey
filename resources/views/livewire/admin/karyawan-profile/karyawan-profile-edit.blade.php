<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-2 row">
                            <select 
                                wire:model="form.idKaryawan"
                                class="form-select" aria-label="select-karyawan">
                                @forelse ($karyawan as $k)
                                <option value="{{ $k->id }}">{{ $k->npp_karyawan }}</option>
                                @empty
                                <option disabled>Maaf npp karyawan tidak ditemukan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 row">
                            <select 
                                wire:model="form.idUnit"
                                class="form-select" aria-label="select-unit">
                                @forelse ($unit as $u)
                                <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                                @empty
                                <option disabled>Maaf unit tidak ditemukan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 row">
                            <select 
                                wire:model="form.idLayanan"
                                class="form-select" aria-label="select-layanan">
                                @forelse ($layanan as $l)
                                <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                                @empty
                                <option disabled>Maaf layanan tidak ditemukan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 row">
                            <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                            <input wire:model="form.namaKaryawan" 
                                type="text" 
                                class="form-control" 
                                id="namaKaryawan" 
                                aria-describedby="namaKaryawanHelp"
                                placeholder="masukan nama karyawan"
                                value="{{ $this->form->namaKaryawan }}">
                            <div id="namaKaryawanHelp" class="form-text">
                                @error('content') <span class="error">{{ $message }}</span> @enderror 
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="align-self-center p-2">
                                <a href="{{ route('root-karyawan-profile') }}"
                                    class="btn btn-outline-secondary">Batal</a>
                            </div>
                            <div class="align-self-center p-2">
                                <button
                                    class="btn btn-outline-primary"
                                    type="submit">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
