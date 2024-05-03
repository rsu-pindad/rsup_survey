<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist

    <main class="container-fluid p-4">
        <div class="bg-body-tertiary p-5 rounded">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Respon</h4>
                        </div>
                        <div class="card-body m-2">
                            <livewire:powergrid.respon-table/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>