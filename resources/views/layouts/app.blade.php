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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Favicon-->
    <!-- <link rel="icon" href="{{ asset('/adminbsb/favicon.ico') }}" type="image/x-icon"> -->
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('/adminbsb/plugins/node-waves/waves.css') }}" rel="stylesheet" >
    <!-- Animation Css -->
    <link href="{{ asset('/adminbsb/plugins/animate-css/animate.css') }}" rel="stylesheet" >
    <!-- Morris Chart Css-->
    <link href="{{ asset('/adminbsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" >
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('/adminbsb/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Custom Css -->
    <link href="{{ asset('/adminbsb/css/style.css') }}" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('/adminbsb/css/themes/all-themes.css') }}" rel="stylesheet" >

</head>
<body class="theme-teal">
	<!-- Page Loader -->
    <div class="page-loader-wrapper">
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
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

	<!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('home') }}"> {{ config('app.name', 'Laravel') }} </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
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
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">john.doe@example.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li class="active">
                        <a href="index.html">
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
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/typography.html">
                            <i class="material-icons">compare</i>
                            <span>Kawin</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/typography.html">
                            <i class="material-icons">pie_chart</i>
                            <span>Grafik</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/typography.html">
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
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>


    <!-- content -->
    <section class="content">
        <div class="container-fluid">
            <div class="body">
                <ol class="breadcrumb breadcrumb-bg-teal align-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><i class="material-icons">attachment</i> File</li>
                </ol>
            </div>

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
    <!-- Morris Plugin Js -->
    <script src="{{ asset('/adminbsb/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/adminbsb/plugins/morrisjs/morris.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('/adminbsb/js/admin.js') }}"></script>
    <script src="{{ asset('/adminbsb/js/pages/index.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('/adminbsb/js/demo.js') }}"></script>

    @yield('scripts')

</body>
</html>