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

    <main class="px-2 m-auto">
        <div class="d-flex flex-row justify-content-center rainbow">
            @if(!$hideRespon)
            <ul class="list-group list-group-horizontal p-4">
                @if(session()->get('userLayananMulti') === 1)
                <p>Layanan Anda Termasuk Kedalam Multiple</p>
                @endif
                @foreach ($respons as $item)
                <li 
                    wire:key="{{ $item->id }}"
                    wire:click="preSave({{ $item->id }})"
                    class="mx-4 border border-2 rounded-4 list-group-item btn-custom"
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
            @endif
        </div>
    </main>

    <footer class="mt-auto">
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
                                            <div class="form-floating @error('namaPasien') is-invalid @enderror">
                                                <input 
                                                    wire:model="namaPasien"
                                                    type="text"
                                                    class="form-control @error('namaPasien') is-invalid @enderror" 
                                                    id="namaPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="namaPasien">Nama Anda</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('namaPasien') <span class="text-danger">{{ $message }}</span> @enderror 
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
                                            <div class="form-floating @error('teleponPasien') is-invalid @enderror">
                                                <input 
                                                    wire:model="teleponPasien"
                                                    type="tel" 
                                                    class="form-control @error('teleponPasien') is-invalid @enderror" 
                                                    id="teleponPasien" 
                                                    placeholder="Nomor telepon">
                                                <label for="teleponPasien">Nomor Telepon</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                @error('teleponPasien') <span class="text-danger">{{ $message }}</span> @enderror 
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
                                    @if($this->hasQuestion !== true)
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
            transform: scale(0.8);
        }

        50% {
            transform: scale(1);
        }

        100% {
            transform: scale(0.8);
        }
    }
    
    .survey-box{
        animation: pulse 6s infinite;
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
        animation-play-state: paused;
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