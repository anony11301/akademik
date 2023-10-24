<!-- Sidebar -->
<ul class="navbar-nav bg-orange sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center container-fluid my-5"
        href="{{ Auth::user()->id_level == 1 ? route('dashboard-management') : route('dashboard-guru') }}">
        <img src="/img/logo-smk.png" alt="logo" class="w-50">
    </a>



    <!-- Divider -->
    <hr class="sidebar-divider
            my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link"
            href="{{ Auth::user()->id_level == 1 ? route('dashboard-management') : route('dashboard-guru') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('management-kelas') }}">
            <i class="fa-solid fa-door-closed"></i>
            <span>Kelas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('management-siswa') }}">
            <i class="fa-solid fa-users"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('absen.index') }}">
            <i class="fa-solid fa-book"></i>
            <span>Absensi</span>
        </a>
    </li>
    @if (Auth::user()->id_level == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggaran') }}">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Pelanggaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-pelanggaran') }}">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Data Pelanggaran</span>
            </a>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
