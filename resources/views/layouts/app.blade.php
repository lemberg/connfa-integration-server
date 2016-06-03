<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connfa</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/iCheck/skins/flat/green.css') }}">
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
    <!-- jVectorMap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/maps/jquery-jvectormap-2.0.3.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/select2/dist/css/select2.min.css') }}">


    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css') }}">

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>Connfa!</span></a>
                </div>

                <div class="clearfix"></div>

                <br />

                <!-- sidebar menu -->
               @include('partials.menu')
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{ URL::asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ URL::asset('assets/vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ URL::asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ URL::asset('assets/vendors/bernii/gauge.js/dist/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ URL::asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ URL::asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ URL::asset('assets/vendors/skycons/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ URL::asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ URL::asset('assets/js/flot/jquery.flot.orderBars.js') }}"></script>
<script src="{{ URL::asset('assets/js/flot/date.js') }}"></script>
<script src="{{ URL::asset('assets/js/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ URL::asset('assets/js/flot/curvedLines.js') }}"></script>
<!-- jVectorMap -->
<script src="{{ URL::asset('assets/js/maps/jquery-jvectormap-2.0.3.min.js') }}"></script>
<!-- bootstrap-datetimepicker -->
<script src="{{ URL::asset('assets/js/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ URL::asset('assets/vendors/ckeditor/ckeditor.js') }}"></script>

<script src="{{ URL::asset('assets/js/jquery.synctranslit.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ URL::asset('assets//vendors/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>
</html>
