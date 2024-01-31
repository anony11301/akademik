    @extends('layouts.dashboard')
    @section('page-content')
        <div class="d-flex card mx-4 px-4 py-4 my-5">
            <div class="py-4">
                <div class="d-flex flex-column">
                    <div class="mb-2">Kelas :</div>
                    <div class="h3" style="color: black">{{ $nama_kelas->nama_kelas }}</div>
                </div>

                <div class="container">
                    {{-- notifikasi form validasi --}}
                    @if ($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif

                    {{-- notifikasi sukses --}}
                    @if ($sukses = Session::get('sukses'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $sukses }}</strong>
                        </div>
                    @endif

                    @if (Auth::user()->id_level == 1)
                        <a href="{{ route('management-tambah-siswa', $id_kelas) }}"
                            class="btn btn-sm btn-primary float-right mb-2">+
                            Tambah
                            Data</a>
                        <a href="#" class="btn btn-primary btn-sm mr-2 float-right mb-2" data-toggle="modal"
                            data-target="#importExcel">Import
                            Data</a>
                        <!-- Import Excel -->
                        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ route('import-siswa', $id_kelas) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                        </div>
                                        <div class="modal-body">

                                            {{ csrf_field() }}

                                            <label>Pilih file excel</label>
                                            <div class="form-group">
                                                <input type="file" name="file" required="required">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('download-template-excel') }}"
                                                class="btn btn-success">Download Template</a>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <a href="{{ route('excel-export-siswa', $id_kelas) }}"
                            class="btn btn-sm btn-success float-right mr-2 mb-2">Export Data</a>
                    @else
                        <a href="{{ route('excel-export-siswa', $id_kelas) }}"
                            class="btn btn-sm btn-success float-right mr-2 mt-2">Export Data</a>
                    @endif


                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="color: black">
                            <tr>
                                @if (Auth::user()->id_level == 1)
                                    <th scope="col">#</th>
                                    <th scope="col" style="white-space: nowrap">NISN</th>
                                    <th scope="col" style="white-space: nowrap">Nama Siswa</th>
                                    <th scope="col" style="white-space: nowrap">Poin</th>
                                    <th scope="col">Aksi</th>
                                @else
                                    <th scope="col">#</th>
                                    <th scope="col" style="white-space: nowrap">NISN</th>
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
                                        <td style="white-space: nowrap">{{ $item->NISN }}</td>
                                        <td style="white-space: nowrap">{{ $item->nama }}</td>
                                        <td style="white-space: nowrap">{{ $item->poin }}</td>
                                        <td class="w-25">
                                            <div class="d-flex">
                                                <div class="w-50 mx-2 ">
                                                    <a href="{{ route('edit-siswa', $item->NISN) }}"
                                                        class="btn btn-sm btn-warning  w-100"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                                <div class="w-50 mx-2">
                                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                                        data-toggle="modal" data-target="#hapusModal{{ $item->NISN }}"
                                                        data-id="{{ $item->NISN }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $no++ }}</td>
                                        <td style="white-space: nowrap">{{ $item->NISN }}</td>
                                        <td style="white-space: nowrap">{{ $item->nama }}</td>
                                        <td style="white-space: nowrap">{{ $item->poin }}</td>
                                    @endif

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="hapusModal{{ $item->NISN }}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                    action="{{ route('delete-siswa', $item->NISN) }}">
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
