<div>
    <form wire:submit="save">
        <div class="mb-2">
        <select 
            wire:model="form.idPenjamin"
            class="form-select" aria-label="select-penjamin">
            <option hidden selected>pilih penjamin</option>
            @forelse ($penjamin as $p)
            <option value="{{ $p->id }}">{{ $p->nama_penjamin }}</option>
            @empty
            <option disabled>Maaf penjamin tidak ditemukan</option>
            @endforelse
        </select>
        </div>
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
            <button class="btn btn-primary" type="submit">Tambah</button>
        </div>
    </form>
</div>
