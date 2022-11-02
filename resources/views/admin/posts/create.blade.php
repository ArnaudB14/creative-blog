@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Création d'un nouvel article :</h1>
    <a href="{{route('posts.index')}}" class="btn btn-primary">Retour à la liste</a>
</div>

{{-- @include("partials.validation") --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('posts.store')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" value="{{old('description')}}"></textarea>
    </div>

    <button class="btn btn-primary">Ajouter</button>

</form>

@endsection