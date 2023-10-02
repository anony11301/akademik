@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('update-siswa', $siswa->NIS) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card px-5 py-5 container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input type="text" name="NIS" class="form-control" value="{{ $siswa->NIS }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" class="form-control">
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ $siswa->id_kelas == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning w-full mt-5 mb-3" id="simpanButton">Edit</button>
            <a href="{{ route('management-siswa') }}" class="btn btn-primary w-full">Kembali</a>
        </div>
    </form>
@endsection
