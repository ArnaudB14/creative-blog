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
    
    
    ​
    <div class="d-flex justify-content-between">
        @if(!$posts->isEmpty())
        <div class="list-group w-75 mb-4">
            @foreach($posts as $post)
            @if ($post->status->name === "Publié")
            <a href="{{route('posts.show', [$post->id , $post->slug])}}" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">{{ $post->title }}</h6>
                        <p class="mb-0 opacity-75">{{ $post->description }}</p>
                        @if ($post->category->name != "Aucune")
                            <p class="mb-0 mt-2"> Catégorie :
                                <span class="badge rounded-pill bg-primary">{{ $post->category->name }}</span>
                            </p>
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
        @else
        <p class="text-center">Il n'y a aucun articles pour le moment</p>
        @endif
        </div>

        <div class="tableau">
            <table class="table border rounded">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="bg-dark text-white">Catégories</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="category-name links">
                        <td><a href="{{route('categories.show', [$category->id , $category->slug])}}" class="text-decoration-none text-body">{{ $category->name }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="bg-dark text-white">Tags</th>
                    </tr>
                </thead>
                <tbody class="links">
                    @foreach ($tags as $tag)
                        <tr class="links">
                            <td><a href="{{route('tags.show', [$tag->id , $tag->slug])}}" class="text-decoration-none text-body">{{$tag->name}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<style>
    .category-name:first-child {
        display: none;
    }

    .tableau {
        width: 20%;
        position: sticky;
    }

    .links td:hover {
        background-color: rgb(212, 212, 212);
    }
</style>