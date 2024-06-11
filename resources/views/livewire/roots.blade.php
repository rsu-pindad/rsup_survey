<div>
    @persist('roots-navbar')
    <livewire:admin.roots-navbar 
    :unitAlamat="$unitAlamat"
    :layanan="$layanan"
    :petugas="$petugas"
    :subLogo="$subLogo"
    />
    @endpersist

    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="display-5 lh-base">
                        {{ $unitNama ?? $appSetting->initial_body_text}}
                    </h1>
                    <div class="lead my-4 d-none d-xs-none d-sm-none d-md-block lh-lg">
                        {!! $unitMoto ?? $appSetting->initial_motto_text !!}
                    </div>
                    <p class="lead">
                        <button 
                            type="button" 
                            class="btn btn-lg btn-success" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalSurvey">
                            Mulai survey
                        </button>
                    </p>
                </div>
                <div class="col-lg-6 px-0">
                    <div class="container">
                        <img 
                            class="img-fluid" 
                            src="{{ basset('photos/'.$mainLogo) }}" 
                            alt="logo" 
                            style="border-radius:12px;box-shadow: 8px 8px 0px 0px lightgreen;">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div
        {{-- wire:key=uniqid() --}}
        wire:ignore.self
        class="modal fade" 
        id="modalSurvey" 
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1" 
        aria-labelledby="modalSurveyLabel" 
        aria-hidden="true">
        
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card border border-0">
                        <div class="card-body">
                            <h4 class="card-text text-center lh-lg text-wrap d-sm-none d-md-block">
                                Terimakasih telah menggunakan layanan kami</br>
                                Mohon partisipasi anda dalam program survey kami, </br>
                                Demi meningkatkan kualitas pelayanan kami, </br>
                                Silahkan isi form data diri pasien dibawah ini. </br>
                                Terimakasih.
                            </h4>
                            <hr class="border border-secondary border-1 opacity-30">
                            <form
                                wire:submit="save" 
                                class="mt-3">
                                <div class="row mb-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-person-circle-question"></i>
                                            </span>
                                            <div 
                                                @error('form.name')
                                                class="form-floating is-invalid"
                                                @else
                                                class="form-floating"
                                                @enderror
                                                >
                                                <input 
                                                    wire:model.defer="form.name"
                                                    type="text" 
                                                    @error('form.name')
                                                    class="form-control is-invalid" 
                                                    @else
                                                    class="form-control" 
                                                    @enderror
                                                    id="namaPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="namaPasien">Nama Anda</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('form.name') <span class="text-danger">{{ $message }}</span> @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div 
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <div 
                                                @error('form.phone')
                                                class="form-floating is-invalid"
                                                @else
                                                class="form-floating"
                                                @enderror
                                                >
                                                <input 
                                                    wire:model="form.phone"
                                                    type="tel" 
                                                    @error('form.phone')
                                                    class="form-control is-invalid" 
                                                    @else
                                                    class="form-control" 
                                                    @enderror
                                                    id="gawaiPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="gawaiPasien">Nomor Gawai</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('form.phone') <span class="text-danger">{{ $message }}</span> @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div 
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-clipboard-list"></i>
                                            </span>
                                            <div 
                                                @error('form.penjamin')
                                                class="form-floating is-invalid"
                                                @else
                                                class="form-floating"
                                                @enderror
                                                >
                                                <select wire:model="form.penjamin" 
                                                    id="penjamin_user"
                                                    @error('form.penjamin')
                                                    class="form-control is-invalid"
                                                    @else
                                                    class="form-control"
                                                    @enderror
                                                    >
                                                    <option hidden>Pilih penjamin</option>
                                                    @forelse ($penjamin as $p)
                                                    <option value="{{ $p->parentPenjamin->id }}">{{ $p->parentPenjamin->nama_penjamin }}</option>
                                                    @empty
                                                    <option disabled>Maaf penjamin tidak ditemukan</option>
                                                    @endforelse
                                                </select>
                                                <label for="penjamin_user">Pilih Penjamin</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('form.penjamin') <span class="text-danger">{{ $message }}</span> @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="align-self-center p-2">
                                        <button
                                            type="submit" 
                                            class="btn btn-primary">
                                            Selanjutnya
                                        </button>
                                    </div>
                                    <div class="align-self-center p-2">
                                        <span wire:loading>Menyimpan</span>
                                    </div>
                                    <div class="align-self-center p-2">
                                        <button wire:loading.remove
                                            type="button" 
                                            class="btn btn-outline-secondary" 
                                            data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @persist('times')
        <footer class="py-5 text-center text-body-secondary">
            <p class="mb-0 fs-5">
                waktu survey
            </p>
            <p 
                x-data 
                x-timeout:1000="$el.innerText=$moment().format('LTS')"
                id="waktuSurvey"
                class="fs-4" 
                >
            </p>
        </footer>
    @endpersist

</div>

@push('scripts')
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush