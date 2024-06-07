<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <header class="mb-auto">
        <div>
            <a href="#" class="float-md-start mb-0 navbar-brand py-3 d-none d-xs-none d-sm-none d-md-block">
                <img 
                    class="d-inline-block align-text-top img-thumbnail" 
                    @if(env('APP_ENV') == 'local')
                    src="{{ asset('storage/basset/photos/'.$subLogo ?? 'default_domain.png') }}" 
                    @else
                    src="{{ asset('public/photos/'.$subLogo ?? 'default_domain.png') }}"
                    @endif
                    alt="logo"
                    width="160"
                    height="60"
                >
            </a>
            <nav class="nav nav-masthead justify-content-center py-0 text-uppercase">
                <p class="nav-link fs-3" style="animation: judul 10s infinite;">
                    Survey Layanan <span class="fw-bold">{{ $layanan }} ({{ \Illuminate\Support\Str::limit($petugas, 5, '..') }})</span><br><span>{{ $penjamin }}</span>
                </p>
                <a href="{{ route('roots-dashboard') }}" class="nav-link fs-3 text-decoration-none">
                    <span class="fw-semibold">kembali</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="px-2 mt-auto mb-auto mx-auto">
        <div class="d-flex flex-row justify-content-center rainbow">
            <ul class="list-group list-group-horizontal p-4">
                @foreach ($respons as $item)
                <li 
                    wire:key="{{ $item->id }}"
                    wire:click="preSave({{ $item->id }})"
                    wire:loading.attr="disabled" 
                    class="mx-4 border border-2 rounded-4 list-group-item btn-custom li-custom"
                    style="max-width: min-content;
                    color:{{ $item->tag_warna_respon }};
                    box-shadow:{{ \Spatie\Color\Hex::fromString($item->tag_warna_respon)->toRgba() }} 0px 8px 22px 0px;
                    cursor:pointer;"
                    >
                    <i class="fa-regular fa-circle-dot my-2"></i>
                    <i class="{{ $item->icon_respon }} fa-6x px-2 survey-box"></i>
                    <p class="h6 my-2 text-uppercase fw-bold">{{ $item->nama_respon }}</p>
                </li>
                @endforeach
            </ul>
        </div>
    </main>

    <footer class="mt-auto">
        {{-- <p class="fs-3">
            waktu survey
        </p> --}}
        <p 
            x-data 
            x-timeout:1000="$el.innerText=$moment().format('LTS')"
            id="waktuSurvey"
            class="fs-3 fw-bold" 
            >
        </p>
    </footer>

    <!-- Modal -->
    <div
        {{-- wire:key=uniqid() --}}
        wire:ignore.self
        class="modal fade" 
        id="modalDataDiri" 
        tabindex="-1" 
        aria-labelledby="modalSurveyLabel" 
        aria-hidden="true">
        
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body mx-auto">
                    <div class="card border border-0">
                        <div class="card-body">
                            <div class="fs-5 card-text lh-sm text-wrap d-sm-none d-md-block" style="text-align: center !important;">
                                Terimakasih telah menggunakan layanan kami</br>
                                Silahkan isi form data diri pasien dibawah ini. </br>
                                Terimakasih.
                            </div>
                            <hr class="border border-secondary border-2 opacity-30">
                            <form
                                wire:submit="save" 
                                class="mt-2">
                                <div class="row mb-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-person-circle-question"></i>
                                            </span>
                                            <div 
                                                @error('form.namaPasien')
                                                class="form-floating is-invalid"
                                                @else
                                                class="form-floating"
                                                @enderror
                                                >
                                                <input 
                                                    wire:model.defer="form.namaPasien"
                                                    type="text" 
                                                    @error('form.namaPasien')
                                                    class="form-control is-invalid" 
                                                    @else
                                                    class="form-control" 
                                                    @enderror
                                                    id="namaPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="namaPasien">Nama Anda</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('form.namaPasien') <span class="text-danger">{{ $message }}</span> @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div 
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-phone"></i>
                                            </span>
                                            <div 
                                                @error('form.teleponPasien')
                                                class="form-floating is-invalid"
                                                @else
                                                class="form-floating"
                                                @enderror
                                                >
                                                <input 
                                                    wire:model="form.teleponPasien"
                                                    type="tel" 
                                                    @error('form.teleponPasien')
                                                    class="form-control is-invalid" 
                                                    @else
                                                    class="form-control" 
                                                    @enderror
                                                    id="gawaiPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="gawaiPasien">Nomor Telepon</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('form.teleponPasien') <span class="text-danger">{{ $message }}</span> @enderror 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="align-self-center p-2">
                                        <button
                                            type="submit" 
                                            class="btn btn-primary">
                                            Selesai
                                        </button>
                                    </div>
                                    <div class="align-self-center p-2">
                                        <span wire:loading>Menyimpan</span>
                                    </div>
                                    @if($this->hasQuestion != true)
                                    <div class="align-self-center p-2">
                                        <button wire:loading.remove
                                            type="button" 
                                            class="btn btn-outline-secondary" 
                                            data-bs-dismiss="modal"
                                            wire:click="cancelledDataDiri"
                                            >
                                            Batal
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@push('styles')
<style>
    @keyframes judul { 
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    /* @keyframes rotate {
        100% {
            transform: rotate(2turn);
        }
    } */

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }
    
    .survey-box{
        animation: pulse 3s infinite;
    }

    .survey-box:hover {
        animation-play-state: paused;
    }

    .btn-custom {
        transition: transform 250ms;
        -webkit-transition: transform 250ms;
        -webkit-transition: -webkit-transform 250ms
        /* transform-style: preserve-3d; */
        /* transition: all 250ms; */
    }
    .btn-custom:hover, .btn-custom:active, .btn-custom:focus {
        transform: translateY(-10px);
        /* transform: rotate3d(0.5, 1, 0, 30deg); */
    }
</style>
@endpush

@script
<script>
    const dataDiriModal = new bootstrap.Modal(document.getElementById('modalDataDiri'), {
        keyboard:false,
        backdrop:true,
        focus:true
    });
    $wire.on('modal-data-diri', () => {
        dataDiriModal.show();
    });
</script>
@endscript

@push('scripts')
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush