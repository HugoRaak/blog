@extends('layouts.admin')

@section('title', 'Tous les signalements')

@section('content')

    <h1 class="text-center">@yield('title')</h1>

    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <td class="align-middle text-center">Sujet</td>
            <td class="align-middle text-center">Raison(s)</td>
            <td class="align-middle text-center">Auteur</td>
            <td class="align-middle text-center">Création</td>
            <td class="align-middle text-center">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td class="align-middle text-center">
                    @switch(get_class($report->reportable))
                        @case(\App\Models\Comment::class)
                            Commentaire de {{$report->reportable->user->name}}
                            @break
                        @case(\App\Models\Reply::class)
                            Réponse de {{$report->reportable->user->name}}
                            @break
                        @case(\App\Models\User::class)
                            Utilisateur {{$report->reportable->name}}
                            @break
                    @endswitch
                </td>
                <td class="align-middle text-center"><p>{{\Illuminate\Support\Str::limit(nl2br($report->message))}}</p></td>
                <td class="align-middle text-center">{{$report->user->name}}</td>
                <td class="align-middle text-center">signalé {{Carbon\Carbon::parse($report->created_at)->ago()}}</td>
                <td class="align-middle text-center">
                    <a href="{{ route('admin.report.show', $report) }}" class="btn btn-primary mt-1">Détails</a>
                    <form action="{{route('admin.report.destroy', $report)}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir supprimer ce signalement ?')" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger mt-1"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$reports->links()}}

@endsection
