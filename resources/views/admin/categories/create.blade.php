@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1>Création d'une nouvelle catégorie :</h1>
    <a href="{{route('categories.index')}}" class="btn btn-primary">Retour à la liste</a>
</div>

{{-- @include("partials.validation") --}}
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

<form action="{{route('categories.store')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label required">Nom de la catégorie</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
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