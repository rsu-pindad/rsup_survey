<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-karyawan-profile')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#karyawanProfileModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Karyawan-Profile
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table id="karyawanProfileTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Layanan</th>
                                <th scope="col">Npp</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawanProfiles as $kp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kp->parentUnit->nama_unit }}</td>
                                        <td>{{ $kp->parentLayanan->nama_layanan }}</td>
                                        <td>{{ $kp->parentKaryawan->npp_karyawan }}</td>
                                        <td>{{ $kp->nama_karyawanprofile }}</td>
                                        <td>{{ $kp->id }}</td>
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
<div class="modal fade" id="karyawanProfileModal" tabindex="-1" aria-labelledby="karyawanProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="karyawanProfileModalLabel">Tambah Karyawan-Profile</h1>
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
    @persist('tabel-karyawan-profile')
    <script type="text/javascript">
        $(document).ready(function(e){
            let karyawanProfileTabel = new $('#karyawanProfileTabel').DataTable();
        })
    </script>
    @endpersist
@endpush