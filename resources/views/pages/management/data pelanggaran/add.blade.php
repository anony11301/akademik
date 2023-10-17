@extends('layouts.dashboard')
@section('page-content')
    <div class="container">
        <h1 class="mb-5">Daftar Siswa {{ $kelas->nama_kelas }}</h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="w-25">NIS</th>
                            <th class="w-50">Nama</th>
                            <th class="w-25">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $siswa)
                            <tr>
                                <td>{{ $siswa->NIS }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addData">Tambah
                                        Pelanggaran</a></td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="addData" tabindex="-1" role="dialog"
                                aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('save-data-pelanggaran', $kelas->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body d-flex flex-column">
                                                <div class="">Nama Siswa:</div>
                                                <div class="mb-2">{{ $siswa->nama }}</div>
                                                <div class="form-group mt-2">
                                                    <input type="text" value="{{ $siswa->NIS }}" name="nis" hidden>
                                                    <label for="id_kelas">Jenis Pelanggaran</label>
                                                    <select class="form-control" name="id_pelanggaran">
                                                        @foreach ($pelanggaran as $pelanggaranItem)
                                                            <option value="{{ $pelanggaranItem->id }}">
                                                                {{ $pelanggaranItem->nama_pelanggaran }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
