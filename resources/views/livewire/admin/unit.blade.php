<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="unitModalLabel">Tambah Unit</h2>
            </div>
            <div class="modal-body">
                <form wire:submit="save">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="py-2">
                                @error('form.namaUnit') 
                                    <span class="error text-danger-emphasis">
                                        {{ $message }}
                                    </span> 
                                @enderror 
                            </div>
                            <div class="form-floating mb-3">
                                <input wire:model.defer="form.namaUnit" 
                                type="text" class="form-control" id="floatingInput" placeholder="RSUP Pindad">
                                <label for="floatingInput">Masukan Nama Unit</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 text-start">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>  
</div>

@section('contents')
    @persist('tabel-unit')
        <main class="container-fluid p-4">
            <div class="bg-body-tertiary p-5 rounded">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unitModal">
                            <i class="fa-solid fa-circle-plus px-2"></i>Unit
                        </button>
                    </div>
                    <div class="card-body m-2">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Unit</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr wire:key="{{ $unit->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->nama_unit }}</td>
                                        <td>
                                            <div>
                                                <button 
                                                    type="button"
                                                    wire:key="{{ $unit->id }}" 
                                                    wire:click="delete"
                                                    class="btn btn-danger">Hapus</button>
                                                <button type="button" class="btn btn-warning">Edit</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    @endpersist
@endsection

@push('dt-scripts')
    @persist('tabel-unit')
    <script type="text/javascript">
        $(document).ready(function(){
            let unitTabel = new $('#unitTabel').DataTable();
        })
    </script>
    @endpersist
@endpush