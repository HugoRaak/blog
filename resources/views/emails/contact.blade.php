<x-mail::message>
# Nouvelle demande de contact

Une nouvelle demande de contact a été fait pour <a href="http://localhost:8000">votre blog.</a>

Prénom : {{$data['surname']}}
Nom : {{$data['name']}}
Email : {{$data['email']}}

**Message :**<br>
{{$data['message']}}

<x-mail::button url="https://www.youtube.com">
Procrastiner
</x-mail::button>

</x-mail::message>
