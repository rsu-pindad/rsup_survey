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

  <main class="container">
      <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
          <div class="row">
              <div class="col-lg-6 px-0">
                  <h1 class="display-4 fst-italic">RSU Pindad</h1>
                  <p class="lead my-3">
                      Memberikan Layanan Kesehatan Untuk Anda dan Keluarga.</br>
                      Kami menerima pasien umum dan BPJS Kesehatan, </br>
                      siap memberikan perawatan terbaik dengan pelayanan profesional dan fasilitas modern.
                  </p>
                  <p class="lead mb-0">
                      {{-- <a href="#" class="text-body-emphasis fw-bold btn btn-success" wire:nagivate>Mulai Survey</a> --}}
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSurvey">
                        Mulai survey
                      </button>
                  </p>
              </div>
              <div class="col-lg-6 px-0">
                  <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="logo" width="72" height="57">
              </div>
          </div>
      </div>
  </main>
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
  <!-- Modal -->
  <div class="modal fade" id="modalSurvey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSurveyLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalSurveyLabel">Form data diri</h1>
        </div>
        <div class="modal-body">
          <figure class="text-center mb-3">
            <blockquote class="blockquote">
              <p>Terimakasih telah menggunakan layanan kami</br>
                Jika berkenan, </br>
                Mohon partisipasi anda dalam program survey kami, </br>
                Demi meningkatkan kualitas layanan kami </br>
                Silahkan isi form data diri dibawah ini. </br>
                Terimakasih
              </p>
            </blockquote>
          </figure>
          <form wire:submit="save"
            class="mt-3">
            <div class="row mb-3">
              <label for="nama_user" class="col-2 col-form-label col-form-label">Nama</label>
              <div class="col-9">
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
              <label for="ponsel_user" class="col-2 col-form-label col-form-label">No Handphone</label>
              <div class="col-9">
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
              <label for="penjamin_user" class="col-2 col-form-label col-form-label">Penjamin</label>
              <div class="col-9">
                @error('form.penjamin') <span class="error text-warning-emphasis">{{ $message }}</span> @enderror 
                  <select wire:model.defer="form.penjamin" 
                    id="penjamin_user"
                    class="form-control">
                    <option selected disabled>Pilih penjamin</option>
                    @forelse ($penjamin as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_penjamin }}</option>
                    @empty
                    <option disabled>Maaf penjamin tidak ditemukan</option>
                    @endforelse
                </select>
              </div>
            </div>
              <div class="d-flex flex-column justify-content-center">
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
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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