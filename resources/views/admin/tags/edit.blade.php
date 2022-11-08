@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Éditer un tag :</h1>
    <a href="{{route('tags.index')}}" class="btn btn-primary">Retour à la liste</a>
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

<form action="{{ route('tags.update', [$tags->id , $tags->slug])}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label required">Nom du tag</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $tags->name }}">
    </div>

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection