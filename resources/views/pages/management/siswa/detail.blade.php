    @extends('layouts.dashboard')
    @section('page-content')
    <div class="flex card mx-4 px-4 py-4 my-5">
        <h1 style="color: black">Data Kelas

            <a href="{{ url('management-tambah-siswa') }}" class="btn btn-sm btn-primary float-right">+ Tambah Data</a>
            <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2">Export Data</a>

        </h1>
        <table class="table table-hover">
            <thead style="color: black">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($siswa as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->NIS }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="w-25">
                        <div class="d-flex">
                            <div class="w-50 mx-2 ">
                                <a href="{{ route('edit-siswa', $item->NIS) }}" class="btn btn-sm btn-warning  w-100">Edit</a>
                            </div>
                            <div class="w-50 mx-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" data-toggle="modal" data-target="#hapusModal" data-id="{{ $item->NIS }}">
                                    Hapus
                                </button>
                            </div>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus siswa ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form id="delete-form" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus siswa ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form id="delete-form" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#hapusModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Tombol yang memicu modal
                    var id = button.data('id'); // Mengambil data-id dari tombol
                    var modal = $(this);
                    var form = modal.find('#delete-form');

                    // Mengatur action form untuk menghapus siswa dengan NIS tertentu
                    form.attr('action', '/delete-siswa/' + id);
                });
            });
        </script>

    </div>
    @endsection
