<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div 
                        @error('form.namaRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model.defer="form.namaRespon" 
                            type="text" 
                            @error('form.namaRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="namaRespon" 
                            aria-describedby="namaResponHelp"
                            placeholder="masukan nama respon">
                        <label for="namaRespon">Nama Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.namaRespon') 
                            <span class="error">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div 
                        @error('form.iconRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="form.iconRespon" 
                        type="text" 
                        @error('form.iconRespon')
                        class="form-control is-invalid" 
                        @else
                        class="form-control" 
                        @enderror
                        id="iconRespon" 
                        aria-describedby="iconResponHelp"
                        placeholder="masukan icon respon">
                        <label for="iconRespon">Icon Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.iconRespon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div
                        @error('form.skorRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="form.skorRespon" 
                            type="number" 
                            @error('form.skorRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="skorRespon" 
                            aria-describedby="skorResponHelp"
                            placeholder="masukan skor respon">
                        <label for="skorRespon">Skor Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.skorRespon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div
                        @error('form.urutanRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror 
                        >
                        <input wire:model="form.urutanRespon" 
                            type="number" 
                            @error('form.urutanRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="urutanRespon" 
                            aria-describedby="urutanResponHelp"
                            placeholder="masukan urutan respon">
                        <label for="urutanRespon">Urutan Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('form.urutanRespon') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation flex-nowrap">
                    <span class="input-group-text">#</span>
                    <input wire:model="form.tagWarnaRespon" 
                        id="tagWarnaRespon" 
                        type="color" 
                        @error('form.tagWarnaRespon')
                        class="form-control form-control-color is-invalid" 
                        @else
                        class="form-control form-control-color" 
                        @enderror
                        aria-describedby="tagWarnaResponHelp">
                </div>
                @error('form.tagWarnaRespon') <span class="text-danger">{{ $message }}</span> @enderror 
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
