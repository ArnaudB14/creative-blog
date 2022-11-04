@extends('layouts.app')

@section('content')

<div class="d-flex flex-column">
    <div class="d-flex align-items-center">
        <h1 class="me-2"> {{ $post->title }} </h1>
        @if ($post->category->name != "Aucune")
            <span class="badge rounded-pill bg-primary">{{ $post->category->name }}</span>
        @endif
    </div>
    <p class="mt-5"> {{ $post->description }} </p>
    @if ($post->file_path)
        <img src="{{ asset('images/' . $post->file_path) }}">
    @endif
    <a href="/" class="mt-5">Retour à l'accueil</a>
</div>

@endsection