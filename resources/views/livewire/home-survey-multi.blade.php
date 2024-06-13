<div class="cover-container d-flex w-100 h-100 p-auto mx-auto flex-column">

    <header class="mb-2">
        <div>
            <a href="#" class="float-md-start mb-0 navbar-brand py-3 d-none d-xs-none d-sm-none d-md-block">
                <img 
                    class="d-inline-block align-text-top img-thumbnail" 
                    src="{{ basset('photos/'.$subLogo ?? 'default_domain.png') }}" 
                    alt="logo"
                    width="160px"
                    height="60px"
                >
            </a>
            <nav class="nav nav-masthead justify-content-center py-0 text-uppercase fs-4">
                <p class="nav-link text-truncate" style="animation: judul 10s infinite;">
                    Survey Pelayanan Penjamin {{  $this->penjamin  }}
                </p>
                <span class="nav-link">
                    <a href="{{ route('roots-dashboard') }}" class="fw-semibold text-decoration-none">kembali</a>
                </span>
            </nav>
        </div>
    </header>

    <main class="px-2">
        <div class="d-flex flex-row justify-content-center">
            @if ($this->jumlahLayanan == session()->get('incrementNilai'))
                @if($this->jumlahLayanan == 0)
                <div wire:transition.out.opacity>
                    <p class="h4 text-uppercase fw-bold">
                        tidak ada layanan, mohon aktifkan pada menu unit
                    </p>
                </div>
                @else
                <div wire:transition.out.opacity>
                    <p class="h3 text-uppercase fw-bold">
                        mohon tunggu nilai sedang di simpan
                    </p>
                </div>
                @endif
            @else
            <ul class="list-group list-group-horizontal">
                @foreach ($this->multiLayanan as $item)
                    @if(!in_array($item->layanan_id, session()->get('idLayanan') ?? []))
                    <li 
                        wire:key="{{ $item->id }}"
                        wire:click="$dispatch('show-layanan', {id: {{ $item->layanan_id }} })"
                        id="items{{ $item->layanan_id }}"
                        class="mx-2 border border-2 rounded-4 list-group-item {{ $this->selectedLayananId == $item->layanan_id ? 'active' : '' }}"
                        style="max-width: min-content;
                        cursor:pointer;"
                        >
                        <p class="h6 my-2 text-uppercase fw-bold">
                            {{ $item->parentLayanan->nama_layanan }}
                        </p>
                    </li>
                    @endif
                @endforeach
            </ul>
            @endif
        </div>
        @if ($setLayanan)
        <div class="d-flex flex-col justify-content-center rainbow"
            style="overflow-x: overlay;
            scroll-behavior:smooth;
            scrollbar-width:none;">
            <ul class="list-group list-group-horizontal p-3">
                @foreach ($this->listRespon as $item)
                <li 
                    wire:key="{{ $item->id }}"
                    wire:click="$dispatch('pre-save', {id: {{ $item->id }} })"
                    class="mx-4 border border-2 rounded-4 list-group-item btn-custom li-custom"
                    style="max-width: min-content;
                        color:{{ $item->tag_warna_respon }};
                        box-shadow:{{ \Spatie\Color\Hex::fromString($item->tag_warna_respon)->toRgba() }} 0px 4px 12px 0px;
                        cursor:pointer;"
                    >
                    <i class="fa-regular fa-circle-dot my-2"></i>
                    <i class="{{ $item->icon_respon }} fa-6x px-2 survey-box"></i>
                    <p class="h6 my-2 text-uppercase fw-bold">{{ $item->nama_respon }}</p>
                </li>
                @endforeach
            </ul>
        @endif
    </main>

    <footer class="mt-3">
        <div class="position-absolute bottom-0 start-0 p-2">
            <button 
                wire:click="$dispatch('ulangi-survey')"
                class="btn btn-outline-primary">Ulangi</button>
        </div>
        <div class="position-absolute bottom-0 start-50 translate-middle-x">
            <p 
                x-data 
                x-timeout:1000="$el.innerText=$moment().format('LTS')"
                id="waktuSurvey"
                class="fs-3 fw-bold" 
                >
            </p>
        </div>
        {{-- <div class="position-absolute bottom-0 end-0"> --}}
            {{-- @if ($this->jumlahLayanan == session()->get('incrementNilai'))
            <button 
                wire:click="preStore"
                class="btn btn-success">Selesai</button>
            @endif --}}
        {{-- </div> --}}
    </footer>
    <!-- Modal -->
    <div
        {{-- wire:key=uniqid() --}}
        wire:ignore.self
        class="modal fade" 
        id="modalDataDiri" 
        tabindex="-1" 
        aria-labelledby="modalSurveyLabel" 
        aria-hidden="true"
        data-enable-remember="{{ $rememberState }}"
        >
        
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body mx-2">
                    <div class="card border border-0">
                        <div class="card-body">
                            <p class="fs-5 card-text lh-sm text-wrap d-sm-none d-md-block" style="text-align: center !important;">
                                Mohon isi form data diri pasien dibawah ini,</br>
                                Untuk menyelesaikan survey, terimakasih
                            </p>
                            <hr class="border border-secondary border-2 opacity-30">
                            <form class="mt-2">
                                <div class="row mb-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div
                                            class="input-group has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-person-circle-question"></i>
                                            </span>
                                            <div class="form-floating @error('namaPasien') is-invalid @enderror">
                                                <input 
                                                    wire:model.defer="namaPasien"
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
                                                    id="gawaiPasien" 
                                                    placeholder="Nama Anda">
                                                <label for="gawaiPasien">Nomor Telepon</label>
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
                                            wire:click="saveModal"
                                            type="button" 
                                            class="btn btn-primary">
                                            Selesai
                                        </button>
                                    </div>
                                    <div class="align-self-center p-2">
                                        <button 
                                            wire:click="$dispatch('ulangi-survey')"
                                            type="button"
                                            class="btn btn-outline-danger">Ulangi
                                        </button>
                                    </div>
                                    <div class="align-self-center p-2">
                                        <span wire:loading wire:target="saveModal">Menyimpan</span>
                                    </div>
                                    @if(session()->get('mustQuestion') != true)
                                    <div class="align-self-center p-2">
                                        <button 
                                            wire:loading.remove
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

    $wire.on('ulangi-survey-diri', () => {
        dataDiriModal.hide();
    })
</script>
@endscript

@push('scripts')
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush