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
        <div class="container-fluid">
            <div class="d-flex flex-column align-items-center p-4">
                <p class="h1">
                    Survey Layanan {{ $layanan }}
                </p>
                <p class="h1 d-none d-sm-none d-md-none d-lg-block">
                    Selamat datang, {{ session()->get('nama_pelanggan') }}
                </p>
            </div>
        </div>
        <div 
            wire:loading.remove
            class="container-fluid">
            <div class="d-flex flex-row flex-wrap justify-content-around text-center p-0 m-4">
                @forelse ($respons as $item)
                <div 
                    wire:key="{{ $item->id }}"
                    wire:transition.out.opacity.duration.200ms 
                    class="p-0 m-4 border border-2"
                    style="max-width: min-content;">
                    <button 
                        type="button"
                        wire:loading.attr="disabled" 
                        wire:click="preSave({{ $item->id }})"
                        class="btn btn-custom m-2"
                        style="color:{{ $item->tag_warna_respon }};">
                        <i class="{{ $item->icon_respon }} fa-6x p-2"></i>
                        <p class="h2">{{ $item->nama_respon }}</p>
                    </button>
                </div>
                @empty
                    <p>tidak ada respon nilai</p>
                @endforelse
            </div>
        </div>
        <div 
            wire:loading
            wire:target="preSave"
            class="container-fluid"
            >
            <div class="d-flex flex-column align-items-center">
                <p class="fs-4">
                    Menilai.....
                </p>
            </div>
        </div>
    </main>

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
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush