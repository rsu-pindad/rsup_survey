<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Respon</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:PowerGrid.ResponTable/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Respon</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.respon.respon-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>