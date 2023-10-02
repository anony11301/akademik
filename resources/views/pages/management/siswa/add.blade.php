@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('siswa.store') }}" method="POST" id="siswa-form">
        @csrf
        <div class="card px-5 py-5 container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input class="form-control" type="text" name="nis" placeholder="NIS" aria-label="NIS">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" placeholder="Nama" aria-label="Nama">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control" name="id_kelas">
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-full mt-5 mb-3" id="simpanButton">Simpan</button>
            <a href="{{ route('management-siswa') }}" class="btn btn-primary w-full">Kembali</a>

        </div>
    </form>
@endsection
