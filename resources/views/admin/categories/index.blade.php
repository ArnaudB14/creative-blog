@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4">Administration des catégories :</h1>
    <div>
        <a class="btn btn-primary px-4 gap-3" href="{{ route('categories.create') }}">Ajouter une catégorie</a>
        <a href="{{route('dashboard')}}" class="btn btn-primary">Retour au dashboard</a>
    </div>
</div>

@if(!$categories->isEmpty())

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

<div class="list-group w-auto mb-4">
    @foreach($categories as $category)
    <div class="list-group-item d-flex gap-3 py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">{{ $category->name }}</h6>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{route('categories.edit', [$category->id , $category->slug])}}" class="text-decoration-none mx-2">
                    <i class="bi bi-pencil-square btn btn-primary btn-sm"></i>
                </a>
                <form action="{{route('categories.delete', [$category->id , $category->slug])}}" method="POST" onclick="if(!confirm('Voulez-vous vraiment supprimer cette catégorie ?')) {return false;}">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 p-0">
                        <i class="bi bi-trash-fill btn btn-danger btn-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach 
    <div class="my-3 mx-auto">
        {{ $categories->links() }}
    </div>
</div>

@endif

@endsection