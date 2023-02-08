<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INSCAPE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('backend/assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">

</head>

<body class="loading" data-layout-config='{"darkMode":false}'>

    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>

    <!-- NAVBAR START -->
    <div class="navbar-custom topnav-navbar">
        <div class="container-fluid">

            <!-- LOGO -->
            <a href="" class="topnav-logo">
                <span class="topnav-logo-lg">
                    <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
                </span>
                <span class="topnav-logo-sm">
                    <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
                </span>
            </a>

            <ul class="list-unstyled topbar-menu float-end mb-0">


                <li class="dropdown notification-list topbar-dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" id="topbar-languagedrop"
                        href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('backend/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">English</span> <i
                            class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu"
                        aria-labelledby="topbar-languagedrop">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <img src="{{ asset('backend/assets/images/flags/indonesia.png') }}" alt="user-image"
                                class="me-1" height="12">
                            <span class="align-middle">Indonesia</span>
                        </a>


                    </div>
                </li>






                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                        id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="account-user-avatar">
                            <img src="{{ asset('backend/assets/images/gambaruserdefult.jpg') }}" alt="user-image"
                                class="rounded-circle">
                        </span>
                        <span>
                            <span class="account-user-name mt-1">{{ Auth::user()->name }}</span>

                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                        aria-labelledby="topbar-userdrop">
                        <!-- item-->
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>


                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="dropdown-item notify-item" type="submit">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </button>
                        </form>

                    </div>
                </li>

            </ul>
            <a class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <div class="app-search dropdown">


                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-notes font-16 me-1"></i>
                        <span>Analytics Report</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-life-ring font-16 me-1"></i>
                        <span>How can I help you?</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-cog font-16 me-1"></i>
                        <span>User profile settings</span>
                    </a>

                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                    </div>

                    <div class="notification-list">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="d-flex">
                                <img class="d-flex me-2 rounded-circle"
                                    src="{{ asset('backend/assets/images/users/avatar-2.jpg') }}"
                                    alt="Generic placeholder image" height="32">
                                <div class="w-100">
                                    <h5 class="m-0 font-14">Erwin Brown</h5>
                                    <span class="font-12 mb-0">UI Designer</span>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="d-flex">
                                <img class="d-flex me-2 rounded-circle"
                                    src="{{ asset('backend/assets/images/users/avatar-5.jpg') }}"
                                    alt="Generic placeholder image" height="32">
                                <div class="w-100">
                                    <h5 class="m-0 font-14">Jacob Deo</h5>
                                    <span class="font-12 mb-0">Developer</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="topnav">
        <div class="container-fluid active">
            <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse active" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="uil-home-alt"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- START HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">

                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Welcome to INSCAPE-PLN
                        </h2>

                        <p class="mb-4 font-16 text-white-50">Sistem ini merupakan website untuk mencari komponen
                            terbaik dari suatu perencanaan yang dibutuhkan oleh PLN</p>

                        <a href="{{ route('dashboard') }}" class="btn btn-success">Preview <i
                                class="mdi mdi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="{{ asset('backend/assets/images/startup.svg') }}" alt=""
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HERO -->



    <!-- START FEATURES 1 -->
    <section class="py-5 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Seluruh Barang</h3>
                        <p class="text-muted mt-2">Berikut ini beberapa gambar yang ada di sisitem inscape..</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                @foreach ($barang as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="card d-block h-100">
                            <img class="card-img-top"
                                src="{{ Storage::disk('s3')->temporaryUrl($item->gambar, now()->addMinutes(5)) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::ucfirst($item->nama_barang) }}</h5>
                                <p class="card-text">{{ Str::ucfirst($item->deskripsi) }}</p>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('barang.detail', $item->id) }}" class="card-link btn btn-sm btn-primary">Detail <i class="uil-eye"></i></a>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                @endforeach
            </div>



        </div>
    </section>
    <!-- END FEATURES 1 -->





    <!-- START FOOTER -->
    <footer class="bg-dark py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5">
                        <p class="text-muted mt-4 text-center mb-0">©INSCAPE-PLN</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- bundle -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>

</html>
