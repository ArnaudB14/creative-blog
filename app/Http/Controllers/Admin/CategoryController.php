<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $categories = Category::latest()->paginate(7);
            return view('admin.categories.index', ['categories' => $categories]);
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('admin.categories.create');
        }
        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            $categories = Category::create([
                 'name' => $validatedData['name'],
            ]);
 
        
            return redirect('categories')->with('success', 'Catégorie créée avec succès');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $posts = Category::find($id)->post()->orderBy('posts.created_at', 'DESC')->latest()->paginate(7);
        $categories = Category::where('id', $id)->where('slug', $slug)->firstOrFail();
        
        return view('admin.categories.show', ['posts' => $posts, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slug)
    {
        if (Auth::check()) {
            $categories = Category::where('id', $id)->where('slug', $slug)->first();
            return view('admin.categories.edit', ['categories' => $categories]);
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour modifier une catégorie');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, $slug)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();
 
            $categories = Category::where('id', $id)->where('slug', $slug)->first()->update([
                 'name' => $validatedData['name'],
            ]);
 
             return redirect('/categories')->with('success', 'Catégorie modifiée avec succès');
         }
 
         return redirect('/')->with('error', 'Vous devez être connecté pour modifier un article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $slug)
    {
        if (Auth::check()) {
            $categories = Category::where('id', $id)->where('slug', $slug)->first()->delete();

            return redirect('/categories')->with('success', 'La catégorie a bien été supprimé');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour supprimer une catégorie');
    }
}
