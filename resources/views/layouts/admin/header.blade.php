<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>chat panel</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />


    <!-- Fonts -->
    <link rel="preconnect" href="{{ asset('admin-asset/fonts.googleapis.com/index.html') }}">
    <link rel="preconnect" href="{{ asset('admin-asset/fonts.gstatic.com/index.html') }}" crossorigin>
    <link
        href="../../../fonts.googleapis.com/css28ebe.css?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin-asset/vendor/fonts/boxicons.css') }}" />


    <link rel="stylesheet" href="{{ asset('admin-asset/css/jquery.dataTables.min.css') }}" />



    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asset/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('admin-asset/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin-asset/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin-asset/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin-asset/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('admin-asset/js/config.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="{{ asset('admin-asset/js/pusher.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('admin-asset/css/live_visitor_style.css') }}">


</head>
