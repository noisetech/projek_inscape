<div class="leftside-menu menuitem-active">

    @php
        $users = auth()->user();

    @endphp

    @if ($users->hasRole('admin') || $users->hasRole('Admin') || $users->hasRole('ADMIN'))
        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <div class="h-100 show" id="leftside-menu-container" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">

                                <!--- Sidemenu -->
                                <ul class="side-nav">

                                    <li class="side-nav-title side-nav-item">Dashboard</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('landing') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Home </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('dashboard') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Dashboard </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-title side-nav-item">Pengadaan</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('pengadaan') }}" class="side-nav-link">
                                            <i class="uil-list-ui-alt"></i>
                                            <span> Pengadaan </span>
                                        </a>
                                    </li>



                                    <li class="side-nav-title side-nav-item">Master</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('tahun') }}" class="side-nav-link">
                                            <i class="uil-calender"></i>
                                            <span> Tahun </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('unit') }}" class="side-nav-link">
                                            <i class="uil-list-ui-alt"></i>
                                            <span> Unit </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('barang') }}" class="side-nav-link">
                                            <i class="uil-backpack"></i>
                                            <span> Barang </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-title side-nav-item">Manage Users</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('users') }}" class="side-nav-link">
                                            <i class="uil-users-alt"></i>
                                            <span> Users </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('permission') }}" class="side-nav-link">
                                            <i class="uil-user-check"></i>
                                            <span> Permissions </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('role') }}" class="side-nav-link">
                                            <i class="uil-user-exclamation"></i>
                                            <span> Role </span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 260px; height: 1625px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 236px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
    @endif

    @if ($users->hasRole('pengawas') || $users->hasRole('Pengawas') || $users->hasRole('PENGAWAS'))
        <a href="index.html" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <div class="h-100 show" id="leftside-menu-container" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">

                                <!--- Sidemenu -->
                                <ul class="side-nav">

                                    <li class="side-nav-title side-nav-item">Dashboard</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('landing') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Home </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('dashboard') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Dashboard </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-title side-nav-item">Pengadaan</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('pengadaan') }}" class="side-nav-link">
                                            <i class="uil-list-ui-alt"></i>
                                            <span> Pengadaan </span>
                                        </a>
                                    </li>



                                    <li class="side-nav-title side-nav-item">Master</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('barang') }}" class="side-nav-link">
                                            <i class="uil-backpack"></i>
                                            <span> Barang </span>
                                        </a>
                                    </li>


                                </ul>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 260px; height: 1625px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 236px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
    @endif

    @if ($users->hasRole('users') || $users->hasRole('Users') || $users->hasRole('USERS'))
        <a href="index.html" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <!-- LOGO -->
        <a href="index.html" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
            </span>
        </a>

        <div class="h-100 show" id="leftside-menu-container" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">

                                <!--- Sidemenu -->
                                <ul class="side-nav">

                                    <li class="side-nav-title side-nav-item">Dashboard</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('landing') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Home </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('dashboard') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Dashboard </span>
                                        </a>
                                    </li>

                                    <li class="side-nav-title side-nav-item">Pengadaan</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('pengadaan') }}" class="side-nav-link">
                                            <i class="uil-list-ui-alt"></i>
                                            <span> Pengadaan </span>
                                        </a>
                                    </li>



                                    <li class="side-nav-title side-nav-item">Master</li>

                                    <li class="side-nav-item">
                                        <a href="{{ route('barang') }}" class="side-nav-link">
                                            <i class="uil-backpack"></i>
                                            <span> Barang </span>
                                        </a>
                                    </li>


                                </ul>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: 260px; height: 1625px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 236px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
            </div>
        </div>
    @endif



    <!-- Sidebar -left -->

</div>
