<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
          crossorigin="anonymous">
    <title>@yield('title') | Blog</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="navbar-brand" href="/">HugoRaak</a>

    @php $routeName = Route::currentRouteName(); @endphp

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'post.')]) href="{{route('post.index')}}">Blog</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4 mb-4" style="min-height: 100vh;">
    @yield('content')
</div>
{{--TODO: footer--}}
<footer class="text-center text-lg-start text-white sticky-footer" style="background-color: #45526e;">
    <div class="container p-4 pb-0">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    HugoRaak
                </h6>
                <p>
                    Voici mon blog
                </p>
            </div>
            <hr class="w-100 clearfix d-md-none" />

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    Liens utiles
                </h6>
                <p>
                    <a class="text-white">Your Account</a>
                </p>
                <p>
                    <a class="text-white">Become an Affiliate</a>
                </p>
                <p>
                    <a class="text-white">Shipping Rates</a>
                </p>
                <p>
                    <a class="text-white">Help</a>
                </p>
            </div>
            <hr class="w-100 clearfix d-md-none" />
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
