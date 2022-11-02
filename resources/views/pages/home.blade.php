@extends('layouts.app')

@section('content')

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-inline-block mb-3" src="https://www.creative-formation.fr/wp-content/themes/creative-formation/assets/lettre-creative.svg" alt="Le C du logo Créative Formation" style="width: 50px">
        <h1 class="display-5 fw-bold">Bienvenue sur le blog de Créative</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Retrouvez-ici nos dernières actualités !</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a class="btn btn-primary btn-lg px-4 gap-3" href="#news">Accédez aux actualités</a>
            </div>
        </div>
    </div>
    ​
    <h1 class="mb-4">Les derniers articles : </h1>
    ​
    <div class="list-group w-auto mb-4">
        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Actualité 1</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">Le 26/10/2022</small>
            </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Actualité 2</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">Le 25/10/2022</small>
            </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Actualité 1</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">Le 24/10/2022</small>
            </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h6 class="mb-0">Actualité 1</h6>
                    <p class="mb-0 opacity-75">Some placeholder content in a paragraph.</p>
                </div>
                <small class="opacity-50 text-nowrap">Le 23/10/2022</small>
            </div>
        </a>
    </div>

@endsection