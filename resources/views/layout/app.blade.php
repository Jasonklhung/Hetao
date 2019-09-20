<!DOCTYPE html>
<html>

<head>
    <title>賀桃</title>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" name="viewport">

    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/linearicons/linearicons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/hetao.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sidebarrwd.css') }}" rel="stylesheet">
    <!-- ▼本頁引用▼ -->
    <link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/jquery-ui.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/fullcalendar.print.css') }}" rel="stylesheet" media="print">
    <link href="{{ asset('public/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/default.css') }}" rel="stylesheet">
    <!-- ▲本頁引用▲ -->

</head>

<body>
    <div id="wrapper">
        @include('layout.sidebar')
        
        @yield('content')
    </div>
        @yield('modal')
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/hetao.js') }}"></script>
    <script src="{{ asset('public/js/rilti.min.js') }}"></script>
    <script src="{{ asset('public/js/sidebarrwd.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datetimepicker.min.js') }}"></script>
    @yield('scripts')
</body>

</html>