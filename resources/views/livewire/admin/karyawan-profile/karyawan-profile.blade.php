<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid px-5">
        <div class="rounded">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Karyawan - Profile</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:PowerGrid.KaryawanProfileTable/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Karyawan - Profile</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:admin.karyawan-profile.karyawan-profile-add/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>