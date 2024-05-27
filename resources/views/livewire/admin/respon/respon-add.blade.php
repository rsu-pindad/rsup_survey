<div>
    <form wire:submit="save">
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div 
                        @error('namaRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model.defer="namaRespon" 
                            type="text" 
                            @error('namaRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="namaRespon" 
                            aria-describedby="namaResponHelp"
                            placeholder="masukan nama respon">
                        <label for="namaRespon" class="form-label">Nama Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('namaRespon') 
                            <span class="error">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div 
                        @error('iconRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="iconRespon" 
                        type="text" 
                        @error('iconRespon')
                        class="form-control is-invalid" 
                        @else
                        class="form-control" 
                        @enderror
                        id="iconRespon" 
                        aria-describedby="iconResponHelp"
                        placeholder="masukan icon respon">
                        <label for="iconRespon" class="form-label">Icon Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('iconRespon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div
                        @error('skorRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror
                        >
                        <input wire:model="skorRespon" 
                            type="number" 
                            @error('skorRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="skorRespon" 
                            aria-describedby="skorResponHelp"
                            placeholder="masukan skor respon">
                        <label for="skorRespon" class="form-label">Skor Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('skorRespon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="input-group has-validation">
                    <div
                        @error('urutanRespon')
                        class="form-floating is-invalid"
                        @else
                        class="form-floating"
                        @enderror 
                        >
                        <input wire:model="urutanRespon" 
                            type="number" 
                            @error('urutanRespon')
                            class="form-control is-invalid" 
                            @else
                            class="form-control" 
                            @enderror
                            id="urutanRespon" 
                            aria-describedby="urutanResponHelp"
                            placeholder="masukan urutan respon">
                        <label for="urutanRespon" class="form-label">Urutan Respon</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('urutanRespon') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="input-group has-validation flex-nowrap">
                    <span class="input-group-text">#</span>
                    <input wire:model="tagWarnaRespon" 
                        id="tagWarnaRespon" 
                        type="color" 
                        @error('tagWarnaRespon')
                        class="form-control form-control-color is-invalid" 
                        @else
                        class="form-control form-control-color" 
                        @enderror
                        aria-describedby="tagWarnaResponHelp">
                </div>
                @error('tagWarnaRespon') <span class="text-danger">{{ $message }}</span> @enderror 
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
