<div>
    @persist('navbars')
        <livewire:admin.roots-admin /> 
    @endpersist
    
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
                    <table wire:key={{ uniqid() }}
                        id="unitTabel" 
                        class="table table-striped" 
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->nama_unit }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('root-unit-edit', $unit->id) }}" 
                                                class="btn btn-outline-info">edit</a>
                                            <button
                                                type="button"
                                                class="btn btn-outline-warning"
                                                wire:click="preDelete({{ $unit->id }})"
                                            >
                                                Hapus 
                                            </button>
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
                                type="text" class="form-control" id="namaUnit" placeholder="RSUP Pindad">
                                <label for="namaUnit">Masukan Nama Unit</label>
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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="unitEditModal" tabindex="-1" aria-labelledby="unitEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="unitEditModalLabel">Edit Unit</h2>
            </div>
            <div class="modal-body">
                <form wire:submit="update">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="py-2">
                                @error('form.namaUnit') 
                                    <span class="error text-danger-emphasis">
                                        {{ $message }}
                                    </span> 
                                @enderror 
                            </div>
                            <div>
                                <input wire:model.defer="form.id" 
                                type="text" id="idUnit">
                            </div>
                            <div class="form-floating mb-3">
                                <input wire:model.defer="form.namaUnit" 
                                type="text" class="form-control" id="namaUnit" placeholder="RSUP Pindad">
                                <label for="namaUnit">Edit Nama Unit</label>
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

@push('dt-scripts')
    <script type="text/javascript">
        // let unitTabel = new $('#unitTabel').DataTable();
        $(document).ready(function(){
            let unitTabel = new $('#unitTabel').DataTable();
        })
        window.addEventListener('DOMContentLoaded', event => {
            // $('#unitTabel').DataTable();
            Livewire.on('post-created', (event) => {
           //
            console.log('event started');
            $('#unitTabel').DataTable().destroy();
            $('#unitTabel').DataTable().draw();
            });
        });
    //     $(function() {
    //     $('body').on('click', '.datatables_show_items', function() {
    //         var $this = $(this);
    //         var $value = $this.data('value');
    //         window.livewire.emit('changeShowItems', $value);
    //     });
    // });
    </script>
@endpush