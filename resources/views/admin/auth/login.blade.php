<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="{{ asset('admin-asset/css/auth_style.css') }}">
  <link href="{{ asset('admin-asset/vendor/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

    <section>
        <div class="container mt-5">
            <div class="row card-alignment">
                <div class="col-md-6">
                    <div class="card shadow">
                        <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                        <div class="card-body">
                            <h3 class="card-title text-center">Chat Portal Login</h3>
                            <h6 class="card-subtitle mb-2 text-muted mt-3">Enter your detail for login</h6>
                                <form action="{{ url('login') }}" method="post" class="form-group">
                                    @csrf
                                    <input type="text" name="email" class="form-control mt-3 shadow" placeholder="enter your email address...">
                                    <input type="password" name="password" class="form-control mt-3 shadow" placeholder="enter your password...">
                                    <button class="btn btn-primary mt-3 shadow" type="submit">Login</button>
                                </form>
                                @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                                 <strong>Error!</strong> {{ Session::get('error') }}
                                </div>


                             @else

                             @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

  </main>

  <script src="{{ asset('admin-asset/vendor/js/bootstrap.js') }}">
  </script>
</body>

</html>
