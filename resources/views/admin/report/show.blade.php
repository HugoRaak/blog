@extends('layouts.admin')

@section('title', 'Signalement n°' . $report->id)

@section('head')
    @vite('resources/css/admin/show.css')
@endsection

@section('content')
    <h1 class='text-center'>@yield('title')</h1>

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
            Utilisateur {{$report->reportable->name}}
        @endif
    </div>

@endsection
