<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ url('logo-unib.png') }}">
        </div>
        <div class="sidebar-brand-text">SI Monitoring Bimbingan Skripsi</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if ( Route::is('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Manajemen
    </div>
    <li class="nav-item @if ( Route::is('profile.*')) active @endif">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Profile</span></a>
    </li>
    @if (Auth::user()->role === 'ADMIN')
    <li class="nav-item @if ( Route::is('data-dosen.*') || Route::is('data-mahasiswa.*') ) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Kelola Data</span>
        </a>
        <div id="collapseBootstrap" class="@if ( Route::is('data-dosen.*') || Route::is('data-mahasiswa.*') ) show active @endif collapse" aria-labelledby="headingBootstrap"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Data</h6>
                <a class="collapse-item @if ( Route::is('data-mahasiswa.*') ) active @endif" href="{{ route('data-mahasiswa.index') }}">Data Mahasiswa</a>
                <a class="collapse-item @if ( Route::is('data-dosen.*') ) active @endif" href="{{ route('data-dosen.index') }}">Data Dosen</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if ( Route::is('bimbingan.monitoring-bimbingan') || Route::is('bimbingan.show-monitoring-bimbingan') ) active @endif">
        <a class="nav-link" href="{{ route('bimbingan.monitoring-bimbingan')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Monitoring Bimbingan</span></a>
    </li>
    <li class="nav-item @if ( Route::is('data-admin.*')) active @endif">
        <a class="nav-link" href="{{ route('data-admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Kelola Data Admin</span></a>
    </li>
    @endif
    @if (Auth::user()->role === 'DOSEN')
    <li class="nav-item @if ( Route::is('bimbingan.show_konfirmasi_persetujuan')) active @endif">
        <a class="nav-link" href="{{ route('bimbingan.show_konfirmasi_persetujuan') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pemberitahuan</span></a>
    </li>
    <li class="nav-item @if ( Route::is('bimbingan.index_bimbingan') || Route::is('bimbingan.detail_bimbingan')) active @endif">
        <a class="nav-link" href="{{ route('bimbingan.index_bimbingan') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bimbingan Mahasiswa</span></a>
    </li>
    <li class="nav-item @if ( Route::is('bimbingan.riwayat-bimbingan-dosen')) active @endif">
        <a class="nav-link" href="{{ route('bimbingan.riwayat-bimbingan-dosen') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Riwayat Bimbingan</span></a>
    </li>
    @endif
    @if (Auth::user()->role === 'MAHASISWA' && Auth::user()->dosen_utama != NULL && Auth::user()->dosen_pendamping != NULL )
    @if (Auth::user()->role === 'MAHASISWA')
    <li class="nav-item @if ( Route::is('bimbingan.show_pembimbing_utama') || Route::is('bimbingan.show_pembimbing_pendamping') || Route::is('bimbingan.riwayat-bimbingan') ) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Bimbingan Skripsi</span>
        </a>
        <div id="collapseBootstrap" class="@if ( Route::is('bimbingan.show_pembimbing_utama') || Route::is('bimbingan.show_pembimbing_pendamping') || Route::is('bimbingan.riwayat-bimbingan') ) show active @endif collapse" aria-labelledby="headingBootstrap"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bimbingan Skripsi</h6>
                <a class="collapse-item @if ( Route::is('bimbingan.show_pembimbing_utama') ) active @endif" href="{{ route('bimbingan.show_pembimbing_utama') }}">Pembimbing 1 (PU)</a>
                <a class="collapse-item @if ( Route::is('bimbingan.show_pembimbing_pendamping') ) active @endif" href="{{ route('bimbingan.show_pembimbing_pendamping') }}">Pembimbing 2 (PP)</a>
                <a class="collapse-item @if ( Route::is('bimbingan.riwayat-bimbingan') ) active @endif" href="{{ route('bimbingan.riwayat-bimbingan') }}">Riwayat Bimbingan</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if ( Route::is('bimbingan.kartu-bimbingan') ||Route::is('bimbingan.show-kartu-bimbingan') ) active @endif">
        <a class="nav-link" href="{{ route('bimbingan.kartu-bimbingan') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Kartu Bimbingan</span></a>
    </li>
    @endif
    @endif
    <hr class="sidebar-divider">
</ul>
