@extends('layouts.dashboard')
@section('page-content')
    <div class="container">
        <div class="my-5 h3" style="color: black">Daftar Siswa {{ $kelas->nama_kelas }}</div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th style="width: 200px">NISN</th>
                                <th style="width: 300px; white-space: nowrap">Nama</th>
                                <th style="width: 300px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $siswa)
                                <tr>
                                    <td>{{ $siswa->NISN }}</td>
                                    <td style="white-space: nowrap">{{ $siswa->nama }}</td>
                                    <td><a href="#" class="btn btn-danger" data-toggle="modal"
                                            data-target="#addData{{ $siswa->NISN }}"><i
                                                class="fa-solid fa-triangle-exclamation"></i></a></td>
                                </tr>
                                <!-- modal -->
                                <div class="modal fade" id="addData{{ $siswa->NISN }}" tabindex="-1" role="dialog"
                                    aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('save-data-pelanggaran', $kelas->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body d-flex flex-column">
                                                    <div class="">Nama Siswa:</div>
                                                    <div class="mb-2">{{ $siswa->nama }}</div>
                                                    <div class="form-group mt-2">
                                                        <input type="text" value="{{ $siswa->NISN }}" name="nisn"
                                                            hidden>
                                                        <label for="id_kelas">Jenis Pelanggaran</label>
                                                        <select class="form-control" name="id_pelanggaran">
                                                            @foreach ($pelanggaran as $pelanggaranItem)
                                                                <option value="{{ $pelanggaranItem->id }}">
                                                                    {{ $pelanggaranItem->nama_pelanggaran }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="mt-3">Keterangan:</div>
                                                        <input type="text" name="keterangan" class="form-control my-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Simpan</button>
                                                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
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
    </div>
@endsection
