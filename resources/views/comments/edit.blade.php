@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Éditer un commentaire :</h1>
    <a href="{{route('account.index')}}" class="btn btn-primary">Retour à la liste</a>
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

<form action="{{ route('comments.update', $comments->id )}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="content" class="form-label required">Commentaire :</label>
        <textarea type="text" class="form-control" id="content" name="content" value="{{ $comments->content }}">{{ $comments->content }}</textarea>
    </div>

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection