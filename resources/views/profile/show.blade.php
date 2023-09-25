@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <h1 class='text-center'>@yield('title')</h1>

    <div class="row mt-4">
        <div class="col-4">
            <img src="@if($user->picture) /storage/{{ $user->picture }} @else /storage/images/profile/default.png @endif"
                 alt="Photo de profile" style="max-height: 150px;">
        </div>
        <div class="col-4">
            <p class="card-text"><b>Nom</b> : {{ $user->name }}</p>
            <p class="card-text"><b>Compte créé</b> : {{ \Carbon\Carbon::parse($user->created_at)->ago() }}</p>
        </div>
        @if(!Auth::user()->authoredReports()->where('reportable_id', $user->id)->where('reportable_type', \App\Models\User::class)->exists() && Auth::user()->id !== $user->id)
            <div class="col-2">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reportModal">
                    <i class="fa-solid fa-flag fa-xs icon-left"></i>Signaler
                </button>

                <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reportModalLabel">Faire un signalement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @livewire('report-form', ['reportable' => $user])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
