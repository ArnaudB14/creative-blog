@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4">Administration des articles :</h1>
    <div>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Retour au dashboard</a>
        <a class="btn btn-primary px-4 gap-3" href="{{ route('posts.create') }}">Ajouter un article</a>
    </div>
</div>

@if(!$posts->isEmpty())

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
    @foreach($posts as $post)
    <div class="list-group-item d-flex gap-3 py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">{{ $post->title }}</h6>
                <p class="mb-0 opacity-75">{{ $post->description }}</p>
                @if ($post->file_path != null)
                    <img src="{{ asset('images/' . $post->file_path) }}" class="post-img my-2">
                @endif
                <p class="mb-0 mt-2"> Statut :
                    @if ($post->status->name === "Publié")
                        <span class="badge rounded-pill bg-success">{{ $post->status->name }}</span>
                    @elseif ($post->status->name === "Brouillon")
                        <span class="badge rounded-pill bg-danger">{{ $post->status->name }}</span>
                    @elseif ($post->status->name === "En attente de validation")
                        <span class="badge rounded-pill bg-warning text-dark">{{ $post->status->name }}</span>
                    @else
                        <span class="badge rounded-pill bg-primary">{{ $post->status->name }}</span>
                    @endif
                </p>
                @if ($post->category->name != "Aucune")
                    <p class="mb-0"> Catégorie :
                        <span class="badge rounded-pill bg-primary">{{ $post->category->name }}</span>
                    </p>
                @endif
                @if (!$post->tag->isEmpty())
                    <p class="mb-0">Tags :
                        @foreach ($post->tag as $postTag)
                            <span class="badge rounded-pill bg-info text-dark">{{$postTag->name}}</span> 
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="d-flex align-items-center">
                <small class="opacity-50 text-nowrap">{{ $post->created_at->format('d/m/Y') }}</small>
                <a href="{{route('posts.edit', [$post->id , $post->slug])}}" class="text-decoration-none mx-2">
                    <i class="bi bi-pencil-square btn btn-primary btn-sm"></i>
                </a>
                <form action="{{route('posts.delete', [$post->id , $post->slug])}}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 p-0" onclick="if(!confirm('Voulez-vous vraiment supprimer cet article ?')) {return false;}">
                        <i class="bi bi-trash-fill btn btn-danger btn-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach 
    <div class="my-3 mx-auto">
        {{ $posts->links() }}
    </div>
</div>

@endif

@endsection

<style>
    .post-img {
        width: 155px;
    }
</style>