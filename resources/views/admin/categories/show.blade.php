@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Liste des articles de la catégorie : {{ $categories->name }}</h1>
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

@if(!$posts->isEmpty())
    <div class="list-group w-auto mb-4">
        @foreach($posts as $post)
        @if ($post->status->name === "Publié")
        <a href="{{route('posts.show', [$post->id , $post->slug])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">{{ $post->title }}</h6>
                    <p class="mb-0 opacity-75">{{ $post->description }}</p>
                    @if ($post->category->name != "Aucune")
                        <span class="badge rounded-pill bg-primary">{{ $post->category->name }}</span>
                    @endif
                </div>
                <small class="opacity-50 text-nowrap">{{ $post->created_at->format('d/m/Y') }}</small>
            </div>
        </a>
        @endif
        @endforeach 
        <div class="my-3 mx-auto">
            {{ $posts->links() }}
        </div>
    </div>

    @else
    <p class="text-center">Il n'y a aucun articles pour le moment</p>
@endif

@endsection
