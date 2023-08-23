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
    <title>@yield('title') | Administration</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Administration</a>

    @php $routeName = Route::currentRouteName(); @endphp

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.post.')]) href="{{route('admin.post.index')}}">Posts</a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link', 'active' => str_starts_with($routeName, 'admin.category.')]) href="{{route('admin.category.index')}}">Catégories</a>
            </li>
        </ul>
        <div class="ms-auto mx-4">
            <form action="{{route('logout')}}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" onclick="confirm('Êtes vous sûr de vouloir vous déconnecter ?')">Se déconnecter</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-4">
    @include('shared.flash')
    @yield('content')
</div>

<script>
    new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
</script>

</body>
</html>
