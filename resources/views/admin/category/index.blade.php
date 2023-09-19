@extends('layouts.admin')

@section('title', 'Tous les categories')

@section('content')

    <h1 class="text-center">@yield('title')</h1>

    <div class="text-center mt-4">
        <a href="{{route('admin.category.create')}}">
            <button class="btn btn-success"><i class="fa-solid fa-plus fa-xs icon-left"></i>Créer une catégorie</button>
        </a>
    </div>

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <td class="align-middle text-center">Nom</td>
                <td class="align-middle text-center">Action</td>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="align-middle text-center">{{$category->name}}</td>
                <td class="align-middle text-center">
                    <a href="{{route('admin.category.edit', $category)}}" class="btn btn-primary">
                        <i class="fa-solid fa-pen fa-xs icon-left"></i>Modifier
                    </a>
                    <form action="{{route('admin.category.destroy', $category)}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir supprimer cette catégorie ?')" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$categories->links()}}

@endsection
