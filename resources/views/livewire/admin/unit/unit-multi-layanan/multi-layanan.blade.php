<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5 py-3">
        <div class="rounded">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Multi Layanan Unit ({{ $this->unitNama }})</h4>
                        </div>
                        <div class="card-body m-2">
                            {{-- {{'["'.$l->id.'"]' }} --}}
                            @foreach ($layanan as $l)
                            <div class="row mb-2">
                                <div class="col-4">
                                    <div class="form-check form-switch mb-2 py-2">
                                        <input 
                                            wire:model.live="layananSelect"
                                            class="form-check-input" 
                                            type="checkbox" 
                                            role="switch" 
                                            wire:key="{{ $l->id }}" 
                                            value="{{ $l->id }}" 
                                            @if($layananSelect->contains('["'.$l->id.'"]')) checked @endif>
                                        <label class="form-check-label" for="{{ $l->id }}">{{ $l->nama_layanan }}</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <a wire:navigate
                                href="{{ route('root-unit') }}"
                                class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left-long"></i> kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
