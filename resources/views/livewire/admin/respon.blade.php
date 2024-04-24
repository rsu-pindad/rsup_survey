<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-respon')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#responModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Respon
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="responTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Respon</th>
                                <th scope="col">Skor Respon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($respons as $respon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $respon->nama_respon }}</td>
                                        <td>{{ $respon->skor_respon }}</td>
                                        <td>{{ $respon->id }}</td>
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
<div class="modal fade" id="responModal" tabindex="-1" aria-labelledby="responModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="responModalLabel">Tambah Respon</h1>
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
    @persist('tabel-respon')
    <script type="text/javascript">
        $(document).ready(function(){
            let responTabel = new $('#responTabel').DataTable();
        })
    </script>
    @endpersist
@endpush