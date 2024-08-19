<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>role diberikan kepada user ({{ $this->namaUser }})</h4>
                        </div>
                        <div class="card-body m-2">
                            {{-- '["'.$p->name.'"]' --}}
                            @foreach ($roles as $r)
                                <div class="form-check form-switch mb-2 py-2">
                                    <input 
                                        wire:model.live="roleSelect"
                                        class="form-check-input" 
                                        type="checkbox" 
                                        role="switch" 
                                        wire:key="{{ $r->id }}" 
                                        value="{{ $r->name }}" 
                                        @if($roleSelect->contains('["'.$r->name.'"]')) checked @endif>
                                    <label class="form-check-label" for="{{ $r->id }}">{{ $r->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <a wire:navigate
                                href="{{ route('root-super-admin-user') }}"
                                class="btn btn-outline-secondary">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</div>