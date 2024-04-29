<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-layanan')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#layananModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Layanan
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="layananTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Layanan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($layanans as $layanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $layanan->nama_layanan }}</td>
                                        <td>{{ $layanan->id }}</td>
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
<div class="modal fade" id="layananModal" tabindex="-1" aria-labelledby="layananModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="layananModalLabel">Tambah Layanan</h1>
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
@persist('tabel-layanan')
<script type="text/javascript">
    $(document).ready(function(){
        let layananTabel = new $('#layananTabel').DataTable();
    })
</script>
@endpersist
@endpush