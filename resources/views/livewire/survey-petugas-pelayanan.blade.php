<div>
    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="#">Logo</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-body-emphasis text-decoration-none" href="#">
                    RUMAH SAKIT UMUM PINDAD BANDUNG</br>
                    Jl. Gatot Subroto No.517, Sukapura, Kec. Kiaracondong, </br>
                    Kota Bandung, Jawa Barat 40285 </br>
                    </a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm btn-outline-secondary mx-4" href="{{ route('sdm') }}">{{ $petugas }}</a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}">Keluar</a>
                </div>
            </div>
        </header>
    </div>
    <div class="container-fluid">
        <div class="d-flex flex-column align-items-center p-4">
            <p class="h1">
                Penilaian Layanan {{ $layanan }}
            </p>
            <p class="h1">
                Selamat datang, {{ session()->get('nama_pelanggan') }}
            </p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex flex-row justify-content-around text-center p-4">
            @forelse ($respons as $item)
            <div wire:key="{{ $item->id }}">
                    <button 
                        type="button"
                        wire:click="save({{ $item->parentRespon->skor_respon }})"
                        wire:confirm="Anda Yakin Akan menilai {{ $layanan }} {{ $item->parentRespon->nama_respon }}"
                        class="btn border border-2">
                        <i class="fa-solid fa-thumbs-up fa-6x p-2"></i>
                        <p class="h2">{{ $item->parentRespon->nama_respon }}</p>
                    </button>
            </div>
                @empty
                <p>tidak ada respon nilai</p>
            @endforelse
        </div>
    </div>
    @persist('times')
    <footer class="py-5 text-center text-body-secondary">
        <p class="mb-0">
            <a href="#" class="text-decoration-none text-muted">waktu survey</a>
        </p>
        <div 
            x-data 
            x-timeout:1000="$el.innerText=$moment().format('LTS')"
            id="waktuSurvey"></div>
    </footer>
    @endpersist

</div>

@push('scripts')
<script src="https://unpkg.com/@victoryoalli/alpinejs-timeout@1.0.0/dist/timeout.min.js" defer></script>
<script src="https://unpkg.com/@mineru98/alpinejs-moment@1.0.3/dist/id/moment.min.js" defer></script>
@endpush