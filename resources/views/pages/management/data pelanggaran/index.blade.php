@extends('layouts.dashboard')
@section('page-content')
    <div class="row px-5 py-5">

        @foreach ($kelas as $item)
            <div class="col col-12 col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="h5 mb-0 font-weight-bold text-warning">{{ $item->nama_kelas }}</div>
                                <small class="text-muted">Tidak Hadir: </small>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item" href="{{ route('absen.show', $item->id) }}">Rekap</a>
                                        <a class="dropdown-item"
                                            href="{{ route('data-pelanggaran-kelas', $item->id) }}">Input
                                            Pelanggaran</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
