@extends('layouts.app')

@section('content')

@include('flash-message')

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

    <div class="mt-5">
        <h3 class="mb-3">Commentaires :</h3>

        <div class="comment-section">
            @foreach($comments as $comment)
            <div class="list-group-item d-flex gap-3 p-3 mb-3 border rounded">
                <div class="d-flex gap-2 w-100">
                    <div>
                        @if ($comment->user->file_path)
                            <img src="{{ asset('images/profile/' . $comment->user->file_path) }}" class="post-comment-img ml-1">
                        @else 
                            <img src="{{ asset('images/profile/default-profile-pic.jpg') }} " class="rounded-circle post-comment-img">
                        @endif
                    </div>
                    <div class="d-flex flex-column ms-1">
                        <small class="opacity-75 text-nowrap"> 
                            <strong>{{ $comment->user->name}}</strong> le <strong>{{ $comment->created_at->format('d/m/Y') }}</strong>
                        </small>
                        <p class="mb-0 mt-2">{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div> 

        <hr class="division">

        <form action="{{ route('comments.store', $post->id)}}" method="post">
            @csrf
        
            <div class="mb-3 add-comment">
                <label for="content" class="form-label required"><strong>Écrire un commentaire</strong></label>
                <textarea type="text" class="form-control" id="content" name="content" value="{{old('content')}}"></textarea>
            </div>
        
            <button class="btn btn-primary">Ajouter un commentaire</button>
        </form>
        
    </div>

    <a href="/" class="mt-5">Retour à l'accueil</a>
</div>

@endsection

<style>
    .comment-section {
      margin-bottom: 4rem;
    }

    .add-comment {
        margin-top: 4rem;
    }

    .post-comment-img {
        width: 30px;
        height: 30px;
    }

    .division {
        margin: 0 25rem;
    }
</style>