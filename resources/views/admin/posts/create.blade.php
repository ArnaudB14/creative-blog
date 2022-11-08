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

<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label required">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label required">Description</label>
        <textarea class="form-control" id="description" name="description" value="{{old('description')}}">{{old('description')}}</textarea>
    </div>

    <div class="mb-3 d-flex flex-column">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file_path" id="file_path" value="{{old('file_path')}}">
    </div>

    <div class="mb-3 d-flex flex-column align-items-start">
        <label for="status" class="form-label required">Statut</label>
            <select name="status_id" class="block w-full mt-1 rounded-md select-post-create">
                @foreach ($statuses as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
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
            {{-- <select name="category_id" class="block w-full mt-1 rounded-md select-post-create selectpicker"> --}}
            <select name="tag_id[]" class="block w-full mt-1 rounded-md select-post-create" multiple>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </label>
    </div>

    <button class="btn btn-primary">Ajouter</button>

</form>

@endsection

<style>
    .required:after {
      content:" *";
      color: red;
    }

    .select-post-create {
        width: 15rem;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript">
     
    $(function () {
	    $('.selectpicker').selectpicker();
    });
    
</script>