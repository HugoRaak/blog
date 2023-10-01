<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2b9b41b5e5.js" crossorigin="anonymous"></script>
    <title>@yield('title') | HugoRaak</title>
    <link rel="icon" href="/storage/images/logo.ico" type="image/x-icon">
    @vite(['resources/js/app.js', 'resources/css/layouts.css'])
    @yield('head', '')
    @livewireStyles
</head>
<body x-data="{showScrollTop: false}"
      @scroll.window="showScrollTop = window.pageYOffset > 350">
<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="navbar-brand mx-4" href="/">
        <img src="/storage/images/logo.png" height="70" alt="logo">
    </a>

    @php $routeName = Route::currentRouteName(); @endphp

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'post.')]) href="{{route('post.index', ['title' => 'all', 'category' => 'all'])}}">
                    <i class="fa-solid fa-pen-nib fa-xs icon-left"></i>Blog
                </a>
            </li>
        </ul>
        <div class="ms-auto mx-4" x-data="{ isOpen: false }">
            @guest
                <a href="{{route('login')}}"><button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-right-to-bracket fa-xs icon-left"></i>Se connecter
                </button></a>
            @endguest
            @auth
                <div class="dropdown" @click.outside="isOpen = false">
                    <button class="btn btn-primary" @click="isOpen = !isOpen">
                        {{ Auth::user()->name }}<i class="fa-solid fa-caret-up fa-xs icon-right" x-show="isOpen"></i><i class="fa-solid fa-caret-down fa-xs icon-right" x-show="!isOpen"></i>
                    </button>
                    <div :class="{ 'show': isOpen }" class="dropdown-menu end-0">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fa-solid fa-user fa-xs icon-left"></i>Profile
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                <i class="fa-solid fa-screwdriver-wrench fa-xs icon-left"></i>Administration
                            </a>
                        @endif
                        <hr class="dropdown-divider">
                        <form method="post" action="{{ route('logout') }}" onsubmit="return confirm('Êtes vous sûr de vouloir vous déconnecter ?')">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fa-solid fa-right-from-bracket fa-xs icon-left"></i>Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-4 mb-4" style="min-height: 100vh;">
    @include('shared.flash')
    @yield('content')
    <div x-data class="scrollTop" x-show="showScrollTop" @click="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <i class="fa-solid fa-chevron-up fa-xl"></i>
    </div>
</div>

<footer class="text-center text-lg-start text-white sticky-footer" style="background-color: #45526e;">
    <div class="container p-4 pb-0">
        <div class="row">
            <div class="col-md-2 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    HugoRaak
                </h6>
                <p>
                    Voici mon blog
                </p>
            </div>
            <hr class="w-100 clearfix d-md-none" />
            <div class="col-md-2 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    Me retrouver
                </h6>
                <a class="text-white text-decoration-none" href="https://github.com/HugoRaak">
                    <i class="fa-brands fa-github icon-left"></i>
                </a>
                <a class="text-white text-decoration-none" href="https://discord.com/users/424588936233484288">
                    <i class="fa-brands fa-discord"></i>
                </a>
            </div>
            <hr class="w-100 clearfix d-md-none" />


            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">
                    Liens utiles
                </h6>
                <p>
                    <a class="text-white" href="{{ route('profile.edit') }}">Votre compte</a>
                </p>
                <p>
                    <a class="text-white" href="#qd-vrai-site-todo">Politique de confidentialité</a>
                </p>
            </div>
            <hr class="w-100 clearfix d-md-none" />
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold text-white">
                    Me contacter
                </h6>
                <a href="{{route('contact.index')}}" class="text-white contact-link">
                    <i class="fa-solid fa-envelope fa-xs icon-left"></i>mail
                </a>
                <p><i class="fa-solid fa-phone fa-xs icon-left"></i>téléphone : +33 0 00 00 00 00</p>
            </div>
        </div>
    </div>
</footer>

@livewireScripts

</body>
</html>
