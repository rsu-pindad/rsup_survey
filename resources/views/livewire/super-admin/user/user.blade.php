<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel User</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:PowerGrid.SuperAdmin.UserTable/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </main>
    
</div>