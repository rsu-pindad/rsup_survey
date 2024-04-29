<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-penjamin')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#penjaminModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Penjamin
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="penjaminTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Penjamin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjamins as $penjamin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $penjamin->parentUnit->nama_unit }}</td>
                                        <td>{{ $penjamin->nama_penjamin }}</td>
                                        <td>{{ $penjamin->id }}</td>
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
<div class="modal fade" id="penjaminModal" tabindex="-1" aria-labelledby="penjaminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="penjaminModalLabel">Tambah Penjamin</h1>
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
    @persist('tabel-penjamin')
    <script type="text/javascript">
        $(document).ready(function(e){
            let penjaminTabel = new $('#penjaminTabel').DataTable();
        })
    </script>
    @endpersist
@endpush