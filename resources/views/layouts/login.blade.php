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
    <link href="{{ URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">
    <div>
        <div id="wrapper">
            <div id="login" class=" form">
                <section class="login_content">

                    @yield('content')

                </section>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            <!-- disable button after first click -->
            $('form').submit(function(){
                $('input[type=submit]', $(this)).prop( 'disabled', true );
            });
        });
    </script>
</body>
</html>
