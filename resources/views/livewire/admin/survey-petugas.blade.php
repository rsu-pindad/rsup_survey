<div>
    @persist('navbars')
    <livewire:admin.roots-admin />
    @endpersist
</div>

@section('contents')
@persist('tabel-survey-petugas')
<main class="container-fluid p-4">
    <div class="rounded">
        <div class="card">
            <div class="card-header">
                <h4>Survey {{Auth::user()->name}} periode {{ now()->format('M Y') }}</h4>
            </div>
            <div class="card-body m-2">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Penjamin</th>
                            <th>Nama Pasien</th>
                            <th>Handphone Pasien</th>
                            <th>Shift</th>
                            <th>Nilai</th>
                            <th>Waktu Survey</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($surveys as $survey)
                        <tr>
                            <td>{{$survey->parentLayanan->nama_layanan}}</td>
                            <td>{{$survey->parentPenjamin->nama_penjamin}}</td>
                            <td>{{$survey->nama_pelanggan}}</td>
                            <td>{{$survey->handphone_pelanggan}}</td>
                            <td>{{$survey->shift}}</td>
                            <td>{{$survey->nilai_skor}}</td>
                            <td>{{$survey->survey_masuk}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">belum ada survey masuk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
    $(document).ready(function() {
        let surveyPetugasTabel = new $('#surveyPetugasTabel').DataTable();
    })

</script>
@endpersist
@endpush
