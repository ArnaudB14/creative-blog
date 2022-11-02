@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Éditer un article :</h1>
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

<form action="{{ url('posts/update/'. $posts->slug)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $posts->title }}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" value="{{old('description')}}">{{$posts->description}}</textarea>
    </div>

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection