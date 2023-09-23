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
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://kit.fontawesome.com/2b9b41b5e5.js" crossorigin="anonymous"></script>
    <title>@yield('title') | Administration HugoRaak</title>
    @vite(['resources/js/app.js', 'resources/css/layouts.css'])
    @yield('head', '')
</head>
<body x-data="{showScrollTop: false}"
      @scroll.window="showScrollTop = window.pageYOffset > 350">
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Administration</a>

    @php $routeName = Route::currentRouteName(); @endphp

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.user.')]) href="{{route('admin.user.index')}}">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.post.')]) href="{{route('admin.post.index')}}">Posts</a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.category.')]) href="{{route('admin.category.index')}}">Catégories</a>
            </li>
        </ul>
        <div class="ms-auto mx-4"  x-data="{ isOpen: false }">
            <div class="dropdown" @click.outside="isOpen = false">
                <button class="btn btn-dark" @click="isOpen = !isOpen">
                    {{ Auth::user()->name }}<i class="fa-solid fa-caret-up fa-xs icon-right" x-show="isOpen"></i><i class="fa-solid fa-caret-down fa-xs icon-right" x-show="!isOpen"></i>
                </button>
                <div class="dropdown-menu end-0" :class="{ 'show': isOpen }">
                    <a class="dropdown-item" href="/">
                        <i class="fa-solid fa-laptop fa-xs icon-left"></i>Retour au site
                    </a>
                    <hr class="dropdown-divider">
                    <form method="post" action="{{ route('logout') }}" onsubmit="return confirm('Êtes vous sûr de vouloir vous déconnecter ?')">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa-solid fa-right-from-bracket fa-xs icon-left"></i>Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-4">
    @include('shared.flash')
    @yield('content')
    <div x-data class="scrollTop" x-show="showScrollTop" @click="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <i class="fa-solid fa-chevron-up fa-xl"></i>
    </div>
</div>

<script>
    new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
</script>

</body>
</html>
