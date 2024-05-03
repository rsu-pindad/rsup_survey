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
                            <label for="namaRespon" class="col-sm-2 col-form-label">Nama Respon</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.namaRespon"
                                type="text" 
                                class="form-control" 
                                id="namaRespon" 
                                value="{{ $this->form->namaRespon }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="iconRespon" class="col-sm-2 col-form-label">Icon Respon</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.iconRespon"
                                type="text" 
                                class="form-control" 
                                id="iconRespon" 
                                value="{{ $this->form->iconRespon }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tagWarnaRespon" class="col-sm-2 col-form-label">Tag Warna Respon</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.tagWarnaRespon"
                                type="color" 
                                class="form-control form-control-color" 
                                id="tagWarnaRespon" 
                                value="{{ $this->form->tagWarnaRespon }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="skorRespon" class="col-sm-2 col-form-label">Skor Respon</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.skorRespon"
                                type="number" 
                                class="form-control" 
                                id="skorRespon" 
                                value="{{ $this->form->skorRespon }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="urutanRespon" class="col-sm-2 col-form-label">Urutan Respon</label>
                            <div class="col-sm-10">
                              <input 
                                wire:model.defer="form.urutanRespon"
                                type="number" 
                                class="form-control" 
                                id="urutanRespon" 
                                value="{{ $this->form->urutanRespon }}">
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
