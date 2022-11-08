@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-4">Administration des tags :</h1>
    <a class="btn btn-primary px-4 gap-3" href="{{ route('tags.create') }}">Ajouter un tag</a>
</div>

@if(!$tags->isEmpty())

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
    @foreach($tags as $tag)
    <div class="list-group-item d-flex gap-3 py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0">{{ $tag->name }}</h6>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{route('tags.edit', [$tag->id , $tag->slug])}}" class="text-decoration-none mx-2">
                    <i class="bi bi-pencil-square btn btn-primary btn-sm"></i>
                </a>
                <form action="{{route('tags.delete', [$tag->id , $tag->slug])}}" method="POST">
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
        {{ $tags->links() }}
    </div>
</div>

@endif

@endsection