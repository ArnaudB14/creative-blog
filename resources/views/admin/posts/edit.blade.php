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

<form action="{{ route('posts.update', [$posts->id , $posts->slug])}}" method="POST" enctype="multipart/form-data">
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

    <div class="mb-3 d-flex flex-column">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file_path" id="file_path" value="{{old('file_path')}}">
        @if ($posts->file_path)
            <img class="w-25 mt-2" src="{{ asset('images/' . $posts->file_path) }}">
        @endif
    </div>

    <div class="mb-3 d-flex flex-column align-items-start">
        <label for="status" class="form-label required">Statut</label>
            <select name="status_id" class="block w-full mt-1 rounded-md select-post-create">
                @foreach ($statuses as $status)
                    <option value="{{$status->id}}" {{ $status->id == $posts->status_id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="mb-3 d-flex flex-column align-items-start">
        <label for="category" class="form-label required">Catégorie</label>
            <select name="category_id" class="block w-full mt-1 rounded-md select-post-create">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </label>
    </div>
 
    <div class="mb-3 d-flex flex-column align-items-start">
        <label for="tag" class="form-label required">Tag(s)</label>
            <select name="tag_id[]" class="block w-full mt-1 rounded-md select-post-create" multiple>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </label>
    </div>

    <button class="btn btn-primary">Modifier</button>

</form>

@endsection

<style>
    .select-post-create {
        width: 15rem;
    }
</style>