@extends('layouts.app')

@section('content')

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


    <div class="px-4 py-5 my-5 text-center">
        <img class="d-inline-block mb-3" src="https://www.creative-formation.fr/wp-content/themes/creative-formation/assets/lettre-creative.svg" alt="Le C du logo Créative Formation" style="width: 50px">
        <h1 class="display-5 fw-bold">Bienvenue sur le blog de Créative</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Retrouvez-ici nos dernières actualités !</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a class="btn btn-primary btn-lg px-4 gap-3" href="#news">Accédez aux actualités</a>
            </div>
        </div>
    </div>
    ​
    <h1 class="mb-4">Les derniers articles : </h1>
    
    @if(!$posts->isEmpty())
    ​
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
    @endif

@endsection