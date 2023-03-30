<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Neweraconnect - {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Ayoub chahid" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-sm.png') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles
</head>

<body>
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->

    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-dark-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">

                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets/images/users/' . Auth::user()->profile_picture) }}"
                                    alt="user-image" width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ Auth::user()->getFullname() }}</h5>
                                <h6 class="my-0 fw-normal">{{ Auth::user()->getUserRole() }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bienvenu !</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil-user me-1"></i>
                                <span>Profil</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <i class="uil-exit me-1"></i>
                                <span>Se deconnecter</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Left Sidebar Start -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="index.html" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="index.html" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-dark-sm.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title">Navigation</li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="side-nav-link fw-bold">
                            <i class="uil-home-alt"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.clients') }}" class="side-nav-link fw-bold">
                            <i class="uil-users-alt"></i>
                            <span> Clients </span>
                        </a>
                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false"
                            aria-controls="sidebarTasks" class="side-nav-link fw-bold">
                            <i class="uil-clipboard-alt"></i>
                            <span> Affectations </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTasks">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ route('admin.affectations') }}">Toutes les affectations</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.affectations.map') }}">Map</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a href="apps-chat.html" class="side-nav-link fw-bold">
                            <i class="uil-technology"></i>
                            <span> Routeurs </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="apps-chat.html" class="side-nav-link fw-bold">
                            <i class="uil-package"></i>
                            <span> Soustraitant </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="#" class="side-nav-link fw-bold">
                            <i class="uil-constructor"></i>
                            <span> Techniciens </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="#" class="side-nav-link fw-bold">
                            <i class="uil-map-pin-alt"></i>
                            <span> Villes </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.plaques') }}" class="side-nav-link fw-bold">
                            <i class="uil-label"></i>
                            <span> Plaques </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="apps-chat.html" class="side-nav-link fw-bold">
                            <i class="uil-box"></i>
                            <span> Stock </span>
                        </a>
                    </li>
                </ul>
                <!--- End Sidemenu -->

                <div class="help-box text-white text-center m-2">
                    <div class="d-grid">
                        <button type="button" class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal"
                            data-bs-target="#standard-modal">Importer B2C</button>
                        <button type="button" class="btn btn-sm btn-primary mb-1">Importer B2B</button>
                        <button type="button" class="btn btn-sm btn-primary mb-1">Importer PIPE</button>
                        <button type="button" class="btn btn-sm btn-success mb-1">Importer listes de
                            Routeurs</button>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!--  Left Sidebar End  -->

        <!-- Start Page Content here -->
        <div class="content-page">
            <div class="content">
                {{ $slot }}
            </div>
        </div>
    </div>
    <!-- END wrapper -->

    @stack('scripts')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var mymap = L.map('”mapid”', {
            center: [51.505, -0.09],
            zoom: 13
        });
    </script>
    <script>
        window.livewire.on('success', () => {
            $('#exportation-modal').modal('hide');
            $('#delete-modal').modal('hide');
            $('#delete-all-modal').modal('hide');
            $('#affecter-modal').modal('hide');
            $('#edit-modal').modal('hide');
            $('#importation-modal').modal('hide');
        });
        window.addEventListener('contentChanged', e => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 15000,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: event.detail.item,
            })
        })
    </script>
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
