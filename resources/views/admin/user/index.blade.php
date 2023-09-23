@extends('layouts.admin')

@section('title', 'Tous les utilisateurs')

@section('content')

    <h1 class="text-center">@yield('title')</h1>

    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <td class="align-middle text-center">Nom</td>
            <td class="align-middle text-center">Email</td>
            <td class="align-middle text-center">Commentaires</td>
            <td class="align-middle text-center">Modification</td>
            <td class="align-middle text-center">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="align-middle text-center">{{$user->name}}</td>
                <td class="align-middle text-center">{{$user->email}}</td>
                <td class="align-middle text-center"><p>{{ $user->comments->count() + $user->replies->count() }}</p></td>
                <td class="align-middle text-center">modifié {{Carbon\Carbon::parse($user->updated_at)->ago()}}</td>
                <td class="align-middle text-center">
                    <a href="{{ route('admin.user.show', $user) }}" class="btn btn-primary">Voir</a>
                    <form action="{{route('admin.user.destroy', $user)}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir supprimer cet utilisateur ?')" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$users->links()}}

@endsection
