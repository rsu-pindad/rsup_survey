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
              <div class="col-lg-6 p-2">
                  <h1 class="display-4">{{ $unitNama ?? $appSetting->initial_body_text}}</h1>
                  <p class="lead my-3 d-none d-xs-none d-md-block">
                      {!! $unitMoto ?? $appSetting->initial_motto_text !!}
                  </p>
                  <p class="lead">
                      <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#modalSurvey">
                        Mulai survey
                      </button>
                  </p>
              </div>
              <div class="col-lg-6 px-0">
                  <div 
                    class="container">
                    {{-- <div class="row"> --}}
                      <img 
                      class="img-fluid" 
                      @if(env('APP_ENV') == 'local')
                      src="{{ asset('storage/basset/photos/'.$mainLogo) }}" 
                      @else
                      src="{{ asset('public/photos/'.$mainLogo) }}"
                      @endif
                      {{-- width="100px" height="100px" --}}
                      alt="logo" 
                      style="border-radius:12px;box-shadow: 8px 8px 0px 0px lightgreen;">
                    </div>
                  {{-- </div> --}}
              </div>
          </div>
      </div>
  </main>
  
  <div class="container">
    @persist('times')
      <footer class="py-5 text-center text-body-secondary bg-body-tertiary">
        <p class="mb-0 fs-5">
          <a href="#" class="text-decoration-none text-muted">waktu survey</a>
        </p>
        <p class="fs-4" 
          x-data 
          x-timeout:1000="$el.innerText=$moment().format('LTS')"
          id="waktuSurvey">
        </p>
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

@push('scripts')
@basset('vendor/alpinejs/timeout.min.js')
@basset('vendor/alpinejs/moment.min.js')
@endpush