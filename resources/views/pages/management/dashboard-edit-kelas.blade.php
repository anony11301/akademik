@extends('layouts.dashboard')
@section('page-content')
    <form action="{{ route('update-kelas', $kelas->id) }}" method="POST" id="kelas-form">
        @csrf
        <div class="card px-5 py-5 container mt-5">
            <p class="my-2"><b style="color: black">Kelas Yang Diedit : {{ $kelas->nama_kelas }}</b></p>
            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="tingkat">Tingkat</label>
                        <select class="form-control" id="tingkat" name="tingkat">
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan">
                            <option value="RPL">Rekaya Perangkat Lunak</option>
                            <option value="MM">Multimedia</option>
                            <option value="TKJ">Teknik Komputer Jaringan</option>
                            <option value="BC">Broadcasting</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rombel">Rombel</label>
                        <select class="form-control" id="rombel" name="rombel">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-full mt-5 mb-3" id="simpanButton">Edit</button>
            <a href="{{ route('dashboard-management-kelas') }}" class="btn btn-primary w-full">Kembali</a>

        </div>

    </form>
@endsection
