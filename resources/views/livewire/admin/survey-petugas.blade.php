<div>
    @persist('navbars')
    <livewire:admin.roots-admin /> 
    @endpersist
</div>

@section('contents')
    @persist('tabel-survey-petugas')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body m-2">
                        <table id="surveyPetugasTabel" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Waktu Shift</th>
                                <th scope="col">Waktu Survey</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($surveys as $survey)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $survey->nama_pelanggan }}</td>
                                        <td>{{ $survey->shift }}</td>
                                        <td>{{ $survey->created_at }}</td>
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
<div class="modal fade" id="surveyPetugasModal" tabindex="-1" aria-labelledby="surveyPetugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="surveyPetugasModalLabel">Tambah Unit</h1>
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

@push('tabel-survey-petugas')
    @persist('tabel-unit')
    <script type="text/javascript">
        $(document).ready(function(){
            let surveyPetugasTabel = new $('#surveyPetugasTabel').DataTable();
        })
    </script>
    @endpersist
@endpush