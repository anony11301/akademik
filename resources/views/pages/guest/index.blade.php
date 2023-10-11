@extends('layouts.app')

@section('page-content')
    <div class="container vh-100">
        <div class="row py-5">
            @foreach ($kelas as $item)
                <div class="col col-12 col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 w-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h5 mb-0 font-weight-bold text-warning">{{ $item->nama_kelas }}</div>
                                    <small class="text-muted">Tidak Hadir: {{ $jumlahTidakHadir[$item->id] }}</small>
                                </div>
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <a href="{{ route('absensi-detail', $item->id) }}"><i
                                                class="fas fa-arrow-right fa-2x text-gray-300"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
