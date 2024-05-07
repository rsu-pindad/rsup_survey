<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-2">
                            <select 
                                wire:model="form.idLayanan"
                                class="form-select" aria-label="select-layanan">
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
                                @forelse ($respon as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_respon }}</option>
                                @empty
                                <option disabled>Maaf respon tidak ditemukan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 d-flex flex-row justify-content-center">
                            <div class="align-self-center p-2">
                                <a href="{{ route('root-layanan-respon') }}"
                                class="btn btn-outline-secondary">Batal</a>
                            </div>
                            <div class="align-self-center p-2">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>