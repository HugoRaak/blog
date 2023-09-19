@extends('layouts.admin')

@section('title', 'Tous les posts')

@section('content')

    <h1 class="text-center">@yield('title')</h1>

    <div class="text-center mt-4">
        <a href="{{route('admin.post.create')}}">
            <button class="btn btn-success"><i class="fa-solid fa-plus fa-xs icon-left"></i>Créer un article</button>
        </a>
    </div>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <td class="align-middle text-center">Titre</td>
                <td class="align-middle text-center">Modification</td>
                <td class="align-middle text-center">Action</td>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="align-middle text-center">{{$post->title}}</td>
                <td class="align-middle text-center">modifié {{Carbon\Carbon::parse($post->updated_at)->ago()}}</td>
                <td class="align-middle text-center">
                    <a href="{{route('admin.post.edit', $post)}}" class="btn btn-primary">
                        <i class="fa-solid fa-pen fa-xs icon-left"></i>Modifier
                    </a>
                    <form action="{{route('admin.post.destroy', $post)}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir supprimer cet article ?')" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$posts->links()}}

@endsection
