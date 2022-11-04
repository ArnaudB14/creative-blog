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
        <label for="title" class="form-label required">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label required">Description</label>
        <textarea class="form-control" id="description" name="description" value="{{old('description')}}"></textarea>
    </div>

    <div class="mb-3">
        <input type="file" name="file" id="file" name="file" value="{{old('file')}}"">
    </div>

    <div class="mb-3 ">
        <label class="block">
            <span class="text-gray-700">Select Category</span>
            <select name="category_id" class="block w-full mt-1 rounded-md">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
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
  </style>