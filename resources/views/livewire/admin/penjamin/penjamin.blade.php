<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid px-5 my-5">
        <div class="rounded">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Penjamin</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:PowerGrid.PenjaminTable/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Penjamin</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.penjamin.penjamin-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>