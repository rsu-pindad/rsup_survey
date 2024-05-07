<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Penjamin Layanan</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:powergrid.penjamin-layanan-table/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Penjamin Layanan</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.penjamin-layanan.penjamin-layanan-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>