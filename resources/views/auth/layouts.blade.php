<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AgilBot</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->


    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.css" integrity="sha512-n1PBkhxQLVIma0hnm731gu/40gByOeBjlm5Z/PgwNxhJnyW1wYG8v7gPJDT6jpk0cMHfL8vUGUVjz3t4gXyZYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vendor CSS Files-->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="../../assets/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js" integrity="sha512-WHVh4oxWZQOEVkGECWGFO41WavMMW5vNCi55lyuzDBID+dHg2PIxVufsguM7nfTYN3CEeQ/6NB46FWemzpoI6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js" integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <nav class="navbar navbar-expand bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    @guest

                    @else
                    <!--                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li> -->


                    <!-- ======= Header ======= -->
                    <header id="header" class="header fixed-top d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="/learn-bot/agil-bot/app/Views/Home/index.php" class="logo d-flex align-items-center">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">AgilBot</span>
                            </a>
                            <i class="bi bi-list toggle-sidebar-btn"></i>
                        </div><!-- End Logo -->

                        <nav class="header-nav ms-auto">

                        </nav><!-- End Icons Navigation -->

                    </header> <!-- End Header -->


                    <!-- ======= Sidebar ======= -->
                    <aside id="sidebar" class="sidebar">

                        <ul class="sidebar-nav" id="sidebar-nav">

                            <li class="nav-item">
                                <a class="nav-link "  href="{{ route('dashboard') }}">
                                    <i class="bi bi-grid"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li><!-- End Dashboard Nav -->

                             <li class="nav-item">
                                <a class="nav-link collapsed" href="{{ route('lista-bot') }}">
                                    <i class="bi bi-card-list"></i>
                                    <span>Bots</span>
                                </a>
                            </li> 

                           <!--  <li class="nav-item">

                                <a class="nav-link collapsed" href="{{ route('menu') }}">
                                    <i class="bi bi-menu-app"></i>
                                    <span>Menu</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="{{ route('menu-sequencial') }}">
                                    <i class="bi bi-card-list"></i>
                                    <span>Sequencial</span>
                                </a>
                            </li> -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="{{ route('historico') }}">
                                    <i class="bi bi-clock-history"></i>
                                    <span>Historico</span>
                                </a>
                            </li><!-- End Blank Page Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed"  href="{{ route('config') }}" >
                                    <i class="bi bi-gear"></i>
                                    <span>Configurações</span>
                                </a>
                            </li><!-- End Profile Page Nav -->

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                    </aside> <!-- End Sidebar-->
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <!-- Vendor JS Files -->
    <!--     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"]) -->
    
    <script src="/../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/../../assets/js/main.js"></script>
    <script src="/../../assets/js/action.js"></script>


</body>

</html>