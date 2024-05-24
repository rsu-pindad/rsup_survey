<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.namaRespon" 
                            type="text" 
                            class="form-control" 
                            id="namaRespon" 
                            aria-describedby="namaResponHelp"
                            placeholder="masukan nama respon">
                        <label for="namaRespon" class="form-label">Nama Respon</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    @error('content') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.iconRespon" 
                        type="text" 
                        class="form-control" 
                        id="iconRespon" 
                        aria-describedby="iconResponHelp"
                        placeholder="masukan icon respon">
                        <label for="iconRespon" class="form-label">Icon Respon</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    @error('content') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.skorRespon" 
                            type="number" 
                            class="form-control" 
                            id="skorRespon" 
                            aria-describedby="skorResponHelp"
                            placeholder="masukan skor respon">
                        <label for="skorRespon" class="form-label">Skor Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('content') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div class="form-floating is-invalid">
                        <input wire:model="form.urutanRespon" 
                            type="number" 
                            class="form-control" 
                            id="urutanRespon" 
                            aria-describedby="urutanResponHelp"
                            placeholder="masukan urutan respon">
                        <label for="urutanRespon" class="form-label">Urutan Respon</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    @error('content') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text">#</span>
                    <input wire:model="form.tagWarnaRespon" 
                        type="color" 
                        class="form-control form-control-color" 
                        id="tagWarnaRespon" 
                        aria-describedby="tagWarnaResponHelp" />
                </div>
                <div class="invalid-feedback">
                    @error('content') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> simpan
                </button>
            </div>
        </div>
    </form>
</div>
