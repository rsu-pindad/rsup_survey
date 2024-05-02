<div>
    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row justify-content-center px-2">
                <div class="col-lg-4 col-md-2 col-xs-2 d-none d-sm-none d-md-block">
                <img class="m-2 px-2" src="http://psurvey.pindadmedika.com/_next/image?url=%2Frsu-pindad.png&w=384&q=75" alt="logo" width="150" height="auto">
                </div>
                <div class="col-lg-4 col-md-8 col-xs-8 d-none d-sm-none d-md-block">
                    <h6 class="text-center text-body-emphasis text-decoration-none">
                    RUMAH SAKIT UMUM PINDAD BANDUNG</br>
                    Jl. Gatot Subroto No.517, Sukapura, Kec. Kiaracondong, </br>
                    Kota Bandung, Jawa Barat 40285 </br>
                    </h6>
                </div>
                <div class="col-lg-4 col-md-2 col-xs-2 d-none d-sm-none d-md-block">
                <div class="d-flex flex-row-reverse m-2 px-2">
                    <a class="btn btn-sm btn-outline-secondary mx-2" href="{{ route('logout') }}">Keluar</a>
                    <a class="btn btn-sm btn-outline-secondary mx-2" href="{{ route('sdm') }}">{{ $petugas }}</a>
                </div>
                </div>
            </div>
        </header>
    </div>

    <main class="container">
        <div class="container-fluid">
            <div class="d-flex flex-column align-items-center p-4">
                <p class="h1">
                    Survey Layanan {{ $layanan }}
                </p>
                <p class="h1">
                    Selamat datang, {{ session()->get('nama_pelanggan') }}
                </p>
            </div>
        </div>
        <div class="container-fluid">
            <div 
                class="d-flex flex-row flex-wrap justify-content-around text-center p-2 m-4">
                @forelse ($respons as $item)
                <div wire:key="{{ $item->id }}" 
                    wire:transition.out.opacity.duration.200ms 
                    wire:loading.attr="disabled" 
                    class="p-3 m-2 border border-2"
                    style="max-width: min-content;">
                    <button 
                        type="button"
                        wire:click="preSave({{ $item->parentRespon->id }})"
                        class="btn btn-custom m-2"
                        style="color:{{ $item->parentRespon->tag_warna_respon }};">
                        <i class="{{ $item->parentRespon->icon_respon }} fa-6x p-2"></i>
                        <p class="h2">{{ $item->parentRespon->nama_respon }}</p>
                    </button>
                </div>
                @empty
                    <p>tidak ada respon nilai</p>
                @endforelse
            </div>
        </div>
    </main>

    <div class="container">
        @persist('times')
            <footer class="py-5 text-center text-body-secondary">
                <p class="mb-0">
                    <a href="#" class="text-decoration-none text-muted">waktu survey</a>
                </p>
                <div 
                    x-data 
                    x-timeout:1000="$el.innerText=$moment().format('LTS')"
                    id="waktuSurvey">
                </div>
            </footer>
        @endpersist
    </div>

</div>

@push('styles')
<style>
    .btn-custom {
        transition: transform 250ms;
    }
    .btn-custom:hover {
        transform: translateY(-10px);
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/@victoryoalli/alpinejs-timeout@1.0.0/dist/timeout.min.js" defer></script>
<script src="https://unpkg.com/@mineru98/alpinejs-moment@1.0.3/dist/id/moment.min.js" defer></script>
@endpush