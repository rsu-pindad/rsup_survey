<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="card">
                <div class="card-body m-2">
                    <form wire:submit="edit" wire:key="{{ $this->form->id }}">
                        <div class="mb-3 row">
                            <label for="namaUnit" class="col-sm-2 col-form-label">Nama Unit</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.namaUnit"
                                type="text" 
                                class="form-control" 
                                id="namaUnit" 
                                value="{{ $this->form->namaUnit }}">
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="align-self-center p-2">
                                <a href="{{ route('root-unit') }}"
                                    class="btn btn-outline-secondary">Batal</a>
                            </div>
                            <div class="align-self-center p-2">
                                <button
                                    class="btn btn-outline-primary"
                                    type="submit">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>
