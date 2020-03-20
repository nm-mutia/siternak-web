<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
	<title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"/>
    <!-- Favicon-->
    <!-- <link rel="icon" href="{{ asset('/adminbsb/favicon.ico') }}" type="image/x-icon"> -->
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet"/>
    <!-- <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <!-- Waves Effect Css -->
    <link href="{{ asset('/adminbsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset('/adminbsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- bootstrap-progressbar -->/
    <link href="{{ asset('/adminbsb/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"/>
    <!-- Custom Css -->
    <link href="{{ asset('/adminbsb/css/style.css') }}" rel="stylesheet"/>
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('/adminbsb/css/themes/all-themes.css') }}" rel="stylesheet" />

    @yield('link')

</head>
<body class="theme-teal">
	<!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

	<!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('home') }}"> {{ config('app.name', 'Laravel') }} - Sistem Informasi Ternak </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <!-- <span class="label-count">7</span> -->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu" style="list-style-type:none;">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- profile -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">{{ Auth::user()->name }}</li>
                            <li class="body">
                                <ul class="menu" style="list-style-type:none;">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">person</i>
                                            </div>
                                            <div class="menu-info" style="top: -3px;">
                                                <h4>Profile</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">input</i>
                                            </div>
                                            <div class="menu-info" style="top: -3px;">
                                                <h4>{{ __('Logout') }}</h4>
                                                
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- /profile -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('adminbsb/images/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selamat Datang, {{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->role }}</div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li>
                        <a href="{{ url('home') }}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="{{ url('ternak') }}">Ternak</a></li>
                            <li><a href="{{ url('home') }}">Ras</a></li>
                            <li><a href="{{ url('home') }}">Penyakit</a></li>
                            <li><a href="{{ url('home') }}">Perkawinan</a></li>
                            <li><a href="{{ url('home') }}">Ternak Mati</a></li>
                            <li><a href="{{ url('home') }}">Pemilik</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('perkawinan') }}">
                            <i class="material-icons">compare</i>
                            <span>Perkawinan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('grafik') }}">
                            <i class="material-icons">pie_chart</i>
                            <span>Grafik</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('laporan') }}">
                            <i class="material-icons">archive</i>
                            <span>Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 <a href="javascript:void(0);"> Sistem Informasi Ternak - SITERNAK </a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>


    <!-- content -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                @yield('title')
            </div>
            <!-- breadcrumb -->
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-teal align-right">
                    @yield('breadcrumb')
                </ol>
            </div>
            <!-- /breadcrumb -->

            @yield('content')
        
        </div>
    </section>
    <!-- /content -->


    <!-- Jquery Core Js -->
    <script src="{{ asset('/adminbsb/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('/adminbsb/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Select Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/node-waves/waves.js') }}"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/jquery-countto/jquery.countTo.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('/adminbsb/js/admin.js') }}"></script>
    <script src="{{ asset('/adminbsb/js/pages/index.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('/adminbsb/js/demo.js') }}"></script>

    @yield('script')

</body>
</html>