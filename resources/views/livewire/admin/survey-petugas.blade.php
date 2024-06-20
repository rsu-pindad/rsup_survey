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
                        <h4>Survey : {{ now() }}</h4>
                    </div>
                    <div class="card-body m-2">
                        <p class="fs-3">Akan segera hadir</p>
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