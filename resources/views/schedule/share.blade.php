<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connfa</title>
    <title>Connfa</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css') }}">
    <!-- Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('assets/images/apple-touch-icon-precomposed.png') }}">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
</head>
<body class="nav-md">
<div id="launch-application" class="container body launch-application">
    <div class="main_container">
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="" role="navigation">
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="buttons">
                        <h3 class="text-center">Please, open the LINK in the web browser (Chrome/Safari) or use the app to complete adding a schedule.</h3>
                        <a href="{{ env('APP_LINK_GOOGLE_PLAY') }}">
                            <img src="{{ URL::asset('assets/images/google-play-icon.png') }}">
                        </a>
                        <a href="{{ env('APP_LINK_APPLE_STORE') }}">
                            <img src="{{ URL::asset('assets/images/apple-store-icon.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Connfa Integration Server
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
</body>
</html>

