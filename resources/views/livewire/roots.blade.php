<div>
  <div class="container">
    <header class="border-bottom lh-2 py-4">
      <div class="row justify-content-center px-2">
        <div class="col-lg-4 col-md-3 col-xs-2 d-none d-xs-none d-md-block">
          <img 
            class="m-2 px-2" 
            src="http://psurvey.pindadmedika.com/_next/image?url=%2Frsu-pindad.png&w=384&q=75" 
            alt="logo" 
            width="150" 
            height="auto">
        </div>
        <div class="col-lg-4 col-md-6 col-xs-8 d-none d-xs-none d-md-block">
          <div class="text-center text-body-emphasis text-decoration-none text-wrap fs-6">
            {!! $unitAlamat !!}
          </div>
        </div>
        <div class="col-lg-4 col-md-3 col-xs-2 d-xs-block d-md-block">
          <div class="d-flex flex-row-reverse m-2 px-2 justify-content-center">
            <a class="btn btn-sm btn-outline-secondary mx-2 align-self-center" href="{{ route('logout') }}">Keluar</a>
            <a class="btn btn-sm btn-outline-secondary mx-2 align-self-center" href="#"> ({{ $layanan }}) {{ $petugas }}</a>
          </div>
        </div>
      </div>
    </header>
  </div>

  <main class="container">
      <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
          <div class="row">
              <div class="col-lg-6 px-0">
                  <h1 class="display-4">{{ $unitNama }}</h1>
                  <p class="lead my-3 d-none d-xs-none d-md-block">
                      Memberikan Layanan Kesehatan Untuk Anda dan Keluarga.</br>
                      Kami menerima pasien umum dan BPJS Kesehatan, </br>
                      siap memberikan perawatan terbaik dengan pelayanan </br>
                      profesional dan fasilitas modern.
                  </p>
                  <p class="lead">
                      <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#modalSurvey">
                        Mulai survey
                      </button>
                  </p>
              </div>
              <div class="col-lg-6 px-0 text-center">
                  <img 
                  class="mb-4" 
                  src="http://psurvey.pindadmedika.com/_next/image?url=%2Fbandung.jpeg&w=828&q=75" 
                  alt="logo" width="100%" height="100%"
                  style="border-radius:12px;box-shadow: 8px 8px 0px 0px lightgreen;">
              </div>
          </div>
      </div>
  </main>
  
  <div class="container">
    @persist('times')
      <footer class="py-5 text-center text-body-secondary bg-body-tertiary">
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

  <!-- Modal -->
  <div wire:transition.scale.origin.top
  class="modal fade" id="modalSurvey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSurveyLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        {{-- <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalSurveyLabel">Form data diri</h1>
        </div> --}}
        <div class="modal-body">
          <div class="card border border-0">
            <div class="card-body">
              <h3 class="card-text text-center">
                Terimakasih telah menggunakan layanan kami</br>
                Mohon partisipasi anda dalam program survey kami, </br>
                Demi meningkatkan kualitas pelayanan kami, </br>
                Silahkan isi form data diri pasien dibawah ini. </br>
                Terimakasih.
              </h3>
              <hr class="border border-secondary border-1 opacity-25">
              <form wire:submit="save"
                class="mt-3">
                <div class="row mb-3">
                  <label for="nama_user" class="col-md-4 col-lg-3 col-form-label col-form-label">Nama Pasien</label>
                  <div class="col-md-8 col-lg-9">
                    @error('form.name') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror 
                    <input wire:model.defer="form.name"
                      type="text" 
                      class="form-control" 
                      id="nama_user" 
                      placeholder="masukan nama anda" 
                      aria-label="nama">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="ponsel_user" class="col-md-4 col-lg-3 col-form-label col-form-label">No Handphone</label>
                  <div class="col-md-8 col-lg-9">
                    @error('form.phone') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror 
                    <input wire:model.defer="form.phone"
                      type="phone" 
                      class="form-control" 
                      id="ponsel_user" 
                      placeholder="nomor ponsel anda" 
                      aria-label="ponsel">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="penjamin_user" class="col-md-4 col-lg-3 col-form-label col-form-label">Penjamin</label>
                  <div class="col-md-8 col-lg-9">
                    @error('form.penjamin') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror 
                      <select wire:model.defer="form.penjamin" 
                        id="penjamin_user"
                        class="form-control">
                        <option hidden>Pilih penjamin</option>
                        @forelse ($penjamin as $p)
                        <option value="{{ $p->parentPenjamin->id }}">{{ $p->parentPenjamin->nama_penjamin }}</option>
                        @empty
                        <option disabled>Maaf penjamin tidak ditemukan</option>
                        @endforelse
                    </select>
                  </div>
                </div>
                <div class="d-flex flex-row justify-content-center">
                  <div class="align-self-center p-2">
                    <button
                      type="submit" 
                      class="btn btn-primary">
                      Mulai Survey
                    </button>
                  </div>
                  <div class="align-self-center p-2">
                    <span wire:loading>Menyimpan</span>
                  </div>
                  <div class="align-self-center p-2">
                    <button wire:loading.remove
                    type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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

@push('styles')
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  
  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }

  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }

  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }

  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }

  .bd-mode-toggle {
    z-index: 1500;
  }

  .bd-mode-toggle .dropdown-menu .active .bi {
    display: block !important;
  }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/@victoryoalli/alpinejs-timeout@1.0.0/dist/timeout.min.js" defer></script>
<script src="https://unpkg.com/@mineru98/alpinejs-moment@1.0.3/dist/id/moment.min.js" defer></script>
@endpush