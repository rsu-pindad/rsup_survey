<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-lr')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#layananResponModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Layanan-Respon
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="layananResponTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Layanan</th>
                                <th scope="col">Nama Respon</th>
                                <th scope="col">Skor Respon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($layananRespons as $lr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lr->parentLayanan->nama_layanan }}</td>
                                        <td>{{ $lr->parentRespon->nama_respon }}</td>
                                        <td>{{ $lr->parentRespon->skor_respon }}</td>
                                        <td>{{ $lr->id }}</td>
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
<div class="modal fade" id="layananResponModal" tabindex="-1" aria-labelledby="layananResponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="layananResponModalLabel">Tambah Layanan-Respon</h1>
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
@persist('tabel-lr')
<script type="text/javascript">
    $(document).ready(function(){
        let layananResponTabel = new $('#layananResponTabel').DataTable();
    })
</script>
@endpersist
@endpush