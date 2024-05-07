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
                            <h4>Tabel Karyawan</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:powergrid.karyawan-table/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Karyawan</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.karyawan.karyawan-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>