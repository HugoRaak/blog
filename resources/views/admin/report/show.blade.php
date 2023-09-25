@extends('layouts.admin')

@section('title', 'Signalement n°' . $report->id)

@section('head')
    @vite('resources/css/admin/show.css')
@endsection

@section('content')
    <h1 class='text-center'>
        @yield('title')
        <form action="{{route('admin.report.destroy', [$report, 'r' => true])}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir supprimer ce signalement ?')" class="ms-4" style="display: inline;">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash fa-xs icon-left"></i>Supprimer</button>
        </form>
    </h1>

    <div class="mt-4">
        <b>Auteur :</b> <a href="{{ route('admin.user.show', $report->user) }}" class="link">{{ $report->user->name }}</a>
        <br><br><b>Raison(s) :</b> {{ $report->message }}<br><br>
        @if(get_class($report->reportable) !== \App\Models\User::class)
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">
                        Commentaire de
                        <a href="{{ route('admin.user.show', $report->reportable->user) }}" class="link">
                            {{$report->reportable->user->name}}
                        </a>
                    </h4>
                    <p class="card-text">{{ $report->reportable->message }}</p>
                    @if(get_class($report->reportable) === \App\Models\Comment::class)
                        <div class="card-footer">
                            sur le post {{ $report->reportable->post->title }}
                        </div>
                    @else
                        <div class="card-footer">
                            En réponse à
                            <a href="{{ route('admin.user.show', $report->reportable->comment->user) }}" class="link">
                                {{ $report->reportable->comment->user->name }}
                            </a>
                            sur le post {{ $report->reportable->comment->post->title }}
                            : {{ $report->reportable->comment->message }}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <b>Utilisateur :</b> <a href="{{ route('admin.user.show', $report->reportable) }}" class="link">{{$report->reportable->name}}</a>
        @endif
    </div>
    <br><br>
    <form action="{{route('admin.report.do', $report)}}" method="post" onsubmit="return confirm('Êtes vous sûr de vouloir traiter ce signalement ? Cela entraînera la suppression du sujet dont il est question et du signalement.')" style="display: inline;">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-warning"><i class="fa-regular fa-circle-check fa-xs icon-left"></i>Traiter</button>
    </form>

@endsection
