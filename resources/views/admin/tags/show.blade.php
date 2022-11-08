@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Liste des articles avec le tag : #{{ $tags->name }}</h1>
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
</div>

@include('flash-message')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="list-group w-auto mb-4">
    @foreach ($tags->post as $tagPost)
    @if ($tagPost->status->name === "Publié")
    <a href="{{route('posts.show', [$tagPost->id , $tagPost->slug])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">{{ $tagPost->title }}</h6>
                <p class="mb-0 opacity-75">{{ $tagPost->description }}</p>
                @if ($tagPost->category->name != "Aucune")
                    <span class="badge rounded-pill bg-primary">{{ $tagPost->category->name }}</span>
                @endif
            </div>
            <small class="opacity-50 text-nowrap">{{ $tagPost->created_at->format('d/m/Y') }}</small>
        </div>
    </a>
    @endif
    @endforeach 
</div>

@endsection