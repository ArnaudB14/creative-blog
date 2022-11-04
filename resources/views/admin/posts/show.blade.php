@extends('layouts.app')

@section('content')

<div class="d-flex flex-column">
    <div class="d-flex align-items-center">
        <h1 class="me-2"> {{ $post->title }} </h1>
        <span class="badge rounded-pill bg-primary">{{ $post->category->name }}</span>
    </div>
    <p class="mt-5"> {{ $post->description }} </p>
    <img src="{{ asset('images/' . $post->file_path) }}">
    <a href="/" class="mt-5">Retour à l'accueil</a>
</div>

@endsection