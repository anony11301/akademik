<!-- Sidebar -->
<ul class="navbar-nav bg-orange sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ Auth::user()->id_level == 1 ? route('dashboard-management') : route('dashboard-guru') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

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
    @if (Auth::user()->id_level == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('management-kelas') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Kelas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management-siswa') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Siswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('absen.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Absensi</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('absen.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Absensi</span>
            </a>
        </li>
    @endif
</ul>
<!-- End of Sidebar -->
