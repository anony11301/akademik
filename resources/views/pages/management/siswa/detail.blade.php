    @extends('layouts.dashboard')
    @section('page-content')
        <div class="d-flex card mx-4 px-4 py-4 my-5">
            <div class="py-4">
                <div class="d-flex flex-column">
                    <div class="mb-2">Kelas :</div>
                    <div class="h3" style="color: black">{{ $nama_kelas->nama_kelas }}</div>
                </div>

                @if (Auth::user()->id_level == 1)
                    <a href="{{ route('management-tambah-siswa', $id_kelas) }}"
                        class="btn btn-sm btn-primary float-right mt-2">+
                        Tambah
                        Data</a>
                    <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2 mt-2">Export Data</a>
                @else
                    <a href="{{ url('excel-export') }}" class="btn btn-sm btn-success float-right mr-2 mt-2">Export Data</a>
                @endif


            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead style="color: black">
                        <tr>
                            @if (Auth::user()->id_level == 1)
                                <th scope="col">#</th>
                                <th scope="col" style="white-space: nowrap">NIS</th>
                                <th scope="col" style="white-space: nowrap">Nama Siswa</th>
                                <th scope="col" style="white-space: nowrap">Poin</th>
                                <th scope="col">Aksi</th>
                            @else
                                <th scope="col">#</th>
                                <th scope="col" style="white-space: nowrap">NIS</th>
                                <th scope="col" style="white-space: nowrap">Nama Siswa</th>
                                <th scope="col" style="white-space: nowrap">Poin</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                @if (Auth::user()->id_level == 1)
                                    <td>{{ $no++ }}</td>
                                    <td style="white-space: nowrap">{{ $item->NIS }}</td>
                                    <td style="white-space: nowrap">{{ $item->nama }}</td>
                                    <td style="white-space: nowrap">{{ $item->poin }}</td>
                                    <td class="w-25">
                                        <div class="d-flex">
                                            <div class="w-50 mx-2 ">
                                                <a href="{{ route('edit-siswa', $item->NIS) }}"
                                                    class="btn btn-sm btn-warning  w-100"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div class="w-50 mx-2">
                                                <button type="button" class="btn btn-sm btn-danger w-100"
                                                    data-toggle="modal" data-target="#hapusModal"
                                                    data-id="{{ $item->NIS }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </td>
                                @else
                                    <td>{{ $no++ }}</td>
                                    <td style="white-space: nowrap">{{ $item->NIS }}</td>
                                    <td style="white-space: nowrap">{{ $item->nama }}</td>
                                    <td style="white-space: nowrap">{{ $item->poin }}</td>

                                @endif

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog"
                                aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <form id="delete-form" method="POST"
                                                action="{{ route('delete-siswa', $item->NIS) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    @endsection
