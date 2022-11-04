@extends('layouts.app')

@section('content')

<h1>Dashboard :</h1>

<div class="d-flex">
    <div class="card mt-5 me-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Articles</h5>
            <p class="card-text">Créer, éditer et supprimer des articles</p>
            <a href="/posts" class="btn btn-primary">Gestion des articles</a>
        </div>
    </div>

    <div class="card mt-5 me-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Catégories</h5>
            <p class="card-text">Créer, éditer et supprimer des catégories</p>
            <a href="/categories" class="btn btn-primary">Gestion des catégories</a>
        </div>
    </div>
</div>

@endsection
