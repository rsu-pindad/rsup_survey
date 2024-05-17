<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>permisi pada role ({{ $this->namaRole }})</h4>
                        </div>
                        <div class="card-body m-2">
                            {{-- '["'.$p->name.'"]' --}}
                            @foreach ($permission as $p)
                                <div class="form-check form-switch mb-2 py-2">
                                    <input 
                                        wire:model.live="permissionSelect"
                                        class="form-check-input" 
                                        type="checkbox" 
                                        role="switch" 
                                        wire:key="{{ $p->id }}" 
                                        value="{{ $p->name }}" 
                                        @if($permissionSelect->contains('["'.$p->name.'"]')) checked @endif>
                                    <label class="form-check-label" for="{{ $p->id }}">{{ $p->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('root-super-admin-role') }}"
                                class="btn btn-outline-secondary">kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</div>