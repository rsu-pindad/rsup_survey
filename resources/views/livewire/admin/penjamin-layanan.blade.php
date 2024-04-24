<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-pl')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#penjaminLayananModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Penjamin-Layanan
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="penjaminLayananTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Unit</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">ID Penjamin</th>
                                <th scope="col">Penjamin</th>
                                <th scope="col">ID Layanan</th>
                                <th scope="col">Layanan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjaminLayanans as $pl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pl->parentPenjaminUnit->id }}</td>
                                        <td>{{ $pl->parentPenjaminUnit->nama_unit }}</td>
                                        <td>{{ $pl->parentPenjamin->id }}</td>
                                        <td>{{ $pl->parentPenjamin->nama_penjamin }}</td>
                                        <td>{{ $pl->parentLayanan->id }}</td>
                                        <td>{{ $pl->parentLayanan->nama_layanan }}</td>
                                        <td>{{ $pl->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </main>
    @endpersist
@endsection

@push('modals')
<!-- Modal -->
<div class="modal fade" id="penjaminLayananModal" tabindex="-1" aria-labelledby="penjaminLayananModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="penjaminLayananModalLabel">Tambah Penjamin-Layanan</h1>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
    </div>
</div>  
@endpush

@push('dt-scripts')
    @persist('tabel-pl')
    <script type="text/javascript">
        $(document).ready(function(){
            let penjaminLayananTabel = new $('#penjaminLayananTabel').DataTable();
        })
    </script>
    @endpersist
@endpush