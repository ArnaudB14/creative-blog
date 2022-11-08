@extends('layouts.app')

@section('content')

<h1>Mon compte :</h1>

@include('flash-message')

<form action="{{ route('account.update', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="d-flex justify-content-around align-items-center">
        <div class="d-flex flex-column mt-5 text-center">
            <div>
                @if (Auth::user()->file_path)
                    <img id="preview-image-before-upload" src="{{ asset('images/profile/' . Auth::user()->file_path) }}" class="rounded-circle account-page-img">
                @else 
                    <img id="preview-image-before-upload" src="{{ asset('images/profile/default-profile-pic.jpg') }} " class="rounded-circle account-page-img">
                @endif
            </div>

            <div class="mt-3">
                <div class="mb-3 d-flex flex-column">
                    <input type="file" name="file_path" id="file_path">
                </div>
            </div>
        </div>

        <div>
            <div class="mb-4">
                <strong>Modifier mes informations :</strong>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label required">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{  Auth::user()->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{  Auth::user()->email }}">
            </div>
        </div>
    </div>

    <button class="btn btn-primary d-block mx-auto save">Enregistrer mes modifications</button>
    
</form>

<hr>

<h3 class="mt-5">Mes commentaires :</h3>

@if ($comments->isEmpty())
    <p class="text-center">Vous n'avez écrit aucun commentaires</p>
@else
    <div class="d-flex flex-wrap w-100">
        @foreach($comments as $comment)
        <div class="card mt-5 me-5 account-card" style="width: 45%;">
            <div class="card-body">
                <h5 class="card-title"><strong>Écrit sur  <a href="{{route('posts.show', [$comment->post->id , $comment->post->slug])}}" class="text-body text-decoration-underline">{{$comment->post->title}}</a> le {{ $comment->created_at->format('d/m/Y') }}</strong></h5>
                <p class="card-text">{{ $comment->content }}</p>
                
                <div class="d-flex justify-content-between">
                    <a href="{{route('posts.show', [$comment->post->id , $comment->post->slug])}}" class="btn btn-primary">Voir l'article</a>
                    <div class="d-flex align-items-end justify-content-end">
                        <a href="{{route('comments.edit', $comment->id)}}" class="text-decoration-none">
                            <i class="bi bi-pencil-square btn btn-primary btn-sm fs-5"></i>
                        </a>
            
                        <form action="{{route('comments.delete', $comment->id)}}" method="POST" class="my-0 ms-3">
                            @csrf
                            @method('DELETE')
                            <button class="border-0 p-0" onclick="if(!confirm('Voulez-vous vraiment supprimer ce commentaire ?')) {return false;}">
                                <i class="bi bi-trash-fill btn btn-danger btn-sm fs-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection

<style>
    .required:after {
      content:" *";
      color: red;
    }

    .account-page-img {
        width: 250px;
        height: 250px;
    }

    .save {
        margin: 6rem auto;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript">
     
    $(document).ready(function (e) {
        $('#file_path').change(function(){
            
            let reader = new FileReader();
        
            reader.onload = (e) => { 
        
            $('#preview-image-before-upload').attr('src', e.target.result); 
            }
        
            reader.readAsDataURL(this.files[0]); 
        });   
    });
    
</script>