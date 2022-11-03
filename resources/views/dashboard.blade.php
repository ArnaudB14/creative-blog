@extends('layouts.app')

@section('content')

<h1>Dashboard :</h1>

<div class="card mt-5" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Articles</h5>
        <p class="card-text">Créer, éditer et supprimer des articles</p>
        <a href="/posts" class="btn btn-primary">Gestion des articles</a>
    </div>
</div>

@endsection
