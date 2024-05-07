<div>
    <form wire:submit="save">
        <div class="mb-2">
        <select 
            wire:model="form.idLayanan"
            class="form-select" aria-label="select-layanan">
            <option hidden selected>pilih layanan</option>
            @forelse ($layanan as $l)
            <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
            @empty
            <option disabled>Maaf layanan tidak ditemukan</option>
            @endforelse
        </select>
        </div>
        <div class="mb-2">
            <select 
                wire:model="form.idRespon"
                class="form-select" aria-label="select-respon">
                <option hidden selected>pilih respon</option>
                @forelse ($respon as $r)
                <option value="{{ $r->id }}">{{ $r->nama_respon }}</option>
                @empty
                <option disabled>Maaf respon tidak ditemukan</option>
                @endforelse
            </select>
        </div>
        <div class="mb-2">
            <button class="btn btn-primary" type="submit">Tambah</button>
        </div>
    </form>
</div>
