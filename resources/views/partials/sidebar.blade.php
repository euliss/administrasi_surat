{{-- ====================================================== --}}
{{-- Ini BATAS --}}
{{-- ====================================================== --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div style="background-color: black">
        <a href="/home" class="brand-link text-decoration-none text-center text-white">
            <span class="brand-text font-weight-light"> <i class="bi bi-envelope-heart"></i> SIMA</span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/home" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door-fill"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profil" class="nav-link {{ Request::is('profil') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                @if (auth()->user()->jabatan === 'Pengurus' || auth()->user()->jabatan === 'Ketua')
                    <li class="nav-item">
                        <a href="/agenda" class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-fill"></i>
                            <p>
                                Agenda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pengajuan" class="nav-link {{ Request::is('pengajuan*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-plus-fill"></i>
                            <p>
                                Pengajuan Surat
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/arsip"
                            class="nav-link {{ Request::is('arsip', 'surat-masuk*', 'surat-keluar*', 'lainnya*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-folder-fill"></i>
                            <p>
                                Arsip
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="/surat-masuk"
                                    class="nav-link {{ Request::is('surat-masuk') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-down-fill"></i>
                                    <p>Surat Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/surat-keluar"
                                    class="nav-link {{ Request::is('surat-keluar') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-up-fill"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/lainnya" class="nav-link {{ Request::is('lainnya') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-fill"></i>
                                    <p>Dokumen Lainnya</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (auth()->user()->jabatan === 'Ketua')
                        <li class="nav-item">
                            <a href="/absensi" class="nav-link {{ Request::is('absensi') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clipboard-check-fill"></i>
                                <p>
                                    Absensi
                                </p>
                            </a>
                        </li>
                    @endif
                @elseif(auth()->user()->jabatan === 'Pembina')
                    <li class="nav-item">
                        <a href="/agenda" class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-fill"></i>
                            <p>
                                Agenda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/arsip"
                            class="nav-link {{ Request::is('arsip', 'surat-masuk*', 'surat-keluar*', 'lainnya*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-folder-fill"></i>
                            <p>
                                Arsip
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="/surat-masuk"
                                    class="nav-link {{ Request::is('surat-masuk') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-down-fill"></i>
                                    <p>Surat Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/surat-keluar"
                                    class="nav-link {{ Request::is('surat-keluar') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-up-fill"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/lainnya" class="nav-link {{ Request::is('lainnya') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-fill"></i>
                                    <p>Dokumen Lainnya</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/absensi" class="nav-link {{ Request::is('absensi') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-check-fill"></i>
                            <p>
                                Absensi
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/user" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                            <i class="nav-icon bi-person-lines-fill"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/agenda" class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-fill"></i>
                            <p>
                                Agenda
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/arsip"
                            class="nav-link {{ Request::is('arsip', 'surat-masuk*', 'surat-keluar*', 'lainnya*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-folder-fill"></i>
                            <p>
                                Arsip
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-3">
                            <li class="nav-item">
                                <a href="/surat-masuk"
                                    class="nav-link {{ Request::is('surat-masuk*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-down-fill"></i>
                                    <p>Surat Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/surat-keluar"
                                    class="nav-link {{ Request::is('surat-keluar*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-arrow-up-fill"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/lainnya" class="nav-link {{ Request::is('lainnya*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-file-earmark-fill"></i>
                                    <p>Dokumen Lainnya</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/absensi" class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clipboard-check-fill"></i>
                            <p>
                                Absensi
                            </p>
                        </a>
                    </li>
                @endif
                {{-- <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="bg-dark text-secondary-100 border-0 nav-icon"
                            style="margin-left: 0.9rem">
                            <i class="nav-icon bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
