<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                        id="selectLayanan"
                        wire:model="form.idLayanan"
                        class="form-select" aria-label="select-layanan">
                        <option hidden selected>pilih layanan</option>
                        @forelse ($layanan as $l)
                        <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                        @empty
                        <option disabled>Maaf layanan tidak ditemukan</option>
                        @endforelse
                    </select>
                    <label for="selectLayanan">Pilih layanan</label>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-floating">
                    <select 
                        id="selectRespon"
                        wire:model="form.idRespon"
                        class="form-select" aria-label="select-respon">
                        <option hidden selected>pilih respon</option>
                        @forelse ($respon as $r)
                        <option value="{{ $r->id }}">{{ $r->nama_respon }}</option>
                        @empty
                        <option disabled>Maaf respon tidak ditemukan</option>
                        @endforelse
                    </select>
                    <label for="selectRespon">Pilih respon</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
