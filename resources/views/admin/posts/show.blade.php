@extends('layouts.app')

@section('content')

<div class="d-flex flex-column">
    <h1> {{ $posts->title }} </h1>
    <p class="mt-5"> {{ $posts->description }} </p>
    <a href="/" class="mt-5">Retour à l'accueil</a>
</div>

@endsection