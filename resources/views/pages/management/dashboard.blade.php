@extends('layouts.dashboard')

@section('page-content')
<!-- Begin Page Content -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/dashboard.css" type="text/css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> 13436 </h3>
                    <p> Data Kelas </p>
                </div>
                <div class="icon">
                    <i class="fa fa-school" aria-hidden="true"></i>
                </div>
                <a href="{{ route('management-kelas') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-orange">
                <div class="inner">
                    <h3> 723 </h3>
                    <p> Data Siswa </p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('management-siswa') }}" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
