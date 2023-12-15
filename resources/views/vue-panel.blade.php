
<!doctype html>
<html lang="en">
  <head>
    <title>Vue Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asset/css/bootstrap-4-3-1.min.css') }}">
    <link rel="stylesheet" href="<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"">
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{asset('admin-asset/css/all-main-style.css')}}">
</head>
  <body style="background-color: #f5f5f9">
    <div id="app">
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('admin-asset/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin-asset/vendor/js/bootstrap.js') }}"></script>
  </body>
</html>
