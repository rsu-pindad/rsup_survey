<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
    <header class="mb-3">
        <livewire:admin.roots-navbar-mobile 
            :unitAlamat="$unitAlamat"
            :layanan="$layanan"
            :petugas="$petugas"
            :subLogo="$subLogo"
        />
    </header>

    <main class="px-2 mt-auto mb-auto">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-7 lh-sm" style="text-align:justify !important;">
                    {{ $unitNama ?? $appSetting->initial_body_text}}
                </h1>
                <div class="my-0 d-none d-xs-none d-sm-none d-md-block lh-sm" style="text-align:justify !important;">
                    {!! $unitMoto ?? $appSetting->initial_motto_text !!}
                </div>
                <p class="lead" style="text-align:end !important;">
                    {{-- <button 
                        type="button" 
                        class="btn btn-lg btn-success" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalSurvey">
                        Mulai survey
                    </button> --}}
                    <button 
                        wire:click="$dispatch('open-penjamin-modal')"
                        type="button" 
                        class="btn btn-lg btn-success"
                        >
                        Mulai survey
                    </button>
                    {{-- <a href="{{ route('isi-survey-pelayanan') }}" class="btn btn-lg btn-success" role="button">Mulai Survey</a> --}}
                </p>
                {{-- <p>
                    Multi Pelayanan {{ session()->get('multiPenilaian') }}
                </p>
                <p>
                    User Layanan Multi {{ session()->get('userLayananMulti') }}
                </p> --}}
            </div>
            <div class="col-lg-4">
                <div class="container">
                    <img 
                        @if(env('APP_ENV') == 'local')
                        src="{{ asset('storage/basset/photos/'.$mainLogo) }}" 
                        @else
                        src="{{ asset('public/photos/'.$mainLogo) }}"
                        @endif
                        alt="logo" 
                        style="border-radius:12px;box-shadow: 8px 8px 0px 0px lightgreen;"
                        >
                        @persist('times')
                            <div class="py-2 text-body-secondary">
                                <span class="mb-0 fs-5">
                                    waktu survey
                                </span>
                                <span 
                                    x-data 
                                    x-timeout:1000="$el.innerText=$moment().format('LTS')"
                                    id="waktuSurvey"
                                    class="fs-4 fw-bold" 
                                    >
                                </span>
                            </div>
                        @endpersist
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-auto">
        <p>2024 &copy; <a href="https://pindadmedika.com/" class="text-decoration-none" target="_blank">PT Pindad Medika Utama</a></p>
    </footer>

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
        
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="card position-absolute top-50 start-50 translate-middle">
                        <div class="card-header mb-auto">
                            <p class="fs-4 text-uppercase">Mohon Pilih Penjamin</p>
                        </div>
                        <div class="card-body my-auto">
                            <form
                                wire:submit="save" 
                                class="mt-2">
                                <div class="row mb-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div 
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-clipboard-list"></i>
                                            </span>
                                            <div class="form-floating @error('form.penjamin') is-invalid @enderror">
                                                <select wire:model="form.penjamin" 
                                                    id="penjamin_user"
                                                    class="form-control @error('form.penjamin') is-invalid @enderror">
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

</div>
@push('scripts')
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush

@script
<script>
    const modalPenjamin = new bootstrap.Modal(document.getElementById('modalSurvey'), {
        keyboard:true,
        backdrop:false,
        focus:true
    });
    $wire.on('open-penjamin-modal', () => {
        modalPenjamin.show();
    });
</script>
@endscript