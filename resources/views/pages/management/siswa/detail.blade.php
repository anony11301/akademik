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
                            <form action="{{ route('delete-siswa', ['NIS' => $item->NIS]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<<<<<<< HEAD

<script>
    $(document).ready(function() {
        $('#hapusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id'); // Mengambil data-id dari tombol
            var modal = $(this);
            var form = modal.find('#delete-form');

            // Mengatur action form untuk menghapus siswa dengan NIS tertentu
            form.attr('action', 'delete-siswa' + NIS);

            // Tambahkan SweetAlert saat tombol "Hapus" pada modal ditekan
            modal.find('.modal-footer button.btn-danger').click(function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak akan dapat mengembalikan ini!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna menekan "Yes", kirimkan form hapus
                        form.submit();
                    }
                });
            });
        });
    });
</script>



=======
>>>>>>> 43ff908bc5e07bd9818307cf2ecfc22120259447
@endsection