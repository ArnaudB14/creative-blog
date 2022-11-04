@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4">Administration des articles :</h1>
    <a class="btn btn-primary px-4 gap-3" href="{{ route('posts.create') }}">Ajouter un article</a>
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
            </div>
            <div>
                <p class="mb-0 opacity-75">{{ $post->category->name }}</p>
            </div>
            <div class="d-flex align-items-center">
                <small class="opacity-50 text-nowrap">{{ $post->created_at->format('d/m/Y') }}</small>
                <a href="{{ url('posts/edit/'. $post->slug)}}" class="text-decoration-none mx-2">
                    <i class="bi bi-pencil-square btn btn-primary btn-sm"></i>
                </a>
                <form action="{{ url('posts/delete/'. $post->slug)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 p-0">
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