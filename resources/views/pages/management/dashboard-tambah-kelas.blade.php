@extends('layouts.dashboard')
@section('page-content')
<form action="{{ route('kelas.store') }}" method="POST" id="kelas-form">
    @csrf
    <div class="container mt-5">
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
            <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="keterangan" id="keterangan">
                <button type="submit" class="btn btn-primary" id="simpanButton">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection