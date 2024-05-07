<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Layanan Respon</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:powergrid.layanan-respon-table/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Layanan Respon</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.layanan-respon.layanan-respon-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>