<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $posts = Post::with('category')->latest()->paginate(7);
            return view('admin.posts.index', ['posts' => $posts]);
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
            $categories = Category::all();
            return view('admin.posts.create', ['categories' => $categories]);
        }
        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            $posts = Post::create([
                 'title' => $validatedData['title'],
                 'description' => $validatedData['description'],
                 'category_id' => $validatedData['category_id'],
            ]);
 
        
            return redirect('posts')->with('success', 'Article créé avec succès');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) 
    {
        $posts = Post::where('slug', $slug)->first();
        return view('admin.posts.show', ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::check()) {
            $posts = Post::where('slug', $slug)->first();
            return view('admin.posts.edit', ['posts' => $posts]);
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour modifier un article');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $slug)
    {

        if (Auth::check()) {
           $validatedData = $request->validated();

           $posts = Post::where('slug', $slug)->first()->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category_id' => $validatedData['category_id'],
           ]);

            return redirect('/posts')->with('success', 'Article modifié avec succès');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour modifier un article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {

        if (Auth::check()) {
            $posts = Post::where('slug', $slug)->first()->delete();

            return redirect('/posts')->with('success', 'L\'article a bien été supprimé');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour supprimer');
    }
}
