<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
    
    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Penjamin</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:powergrid.penjamin-table/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>