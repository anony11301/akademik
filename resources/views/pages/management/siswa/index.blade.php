@extends('layouts.dashboard')
@section('page-content')
    <div class="row px-5 py-5">

        @foreach ($kelas as $item)
            <div class="col col-12 col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-warning">{{ $item->nama_kelas }}</div>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('data-siswa', $item->id) }}"><i
                                        class="fas fa-arrow-right fa-2x text-gray-300"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@if (session('success'))    
@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "Berhasil",
        text: "Data telah terhapus!",
        icon: "success"
    });
</script>
@endpush
@endif
