<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $tags = Tag::latest()->paginate(7);
            return view('admin.tags.index', ['tags' => $tags]);
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
            return view('admin.tags.create');
        }
        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            $tags = Tag::create([
                 'name' => $validatedData['name'],
            ]);
 
        
            return redirect('tags')->with('success', 'Tag créé avec succès');
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
        DB::enableQueryLog();
        $posts = Tag::find($id)->post()->orderBy('posts.created_at', 'DESC')->get();
        //dd(DB::getQueryLog());
        $tags = Tag::where('id', $id)->where('slug', $slug)->firstOrFail();
        
        return view('admin.tags.show', ['posts' => $posts, 'tags' => $tags]);
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
            $tags = Tag::where('id', $id)->where('slug', $slug)->first();
            return view('admin.tags.edit', ['tags' => $tags]);
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour modifier un tag');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id, $slug)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();
 
            $tags = Tag::where('id', $id)->where('slug', $slug)->first()->update([
                 'name' => $validatedData['name'],
            ]);
 
             return redirect('/tags')->with('success', 'Tag modifié avec succès');
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
            $tags = Tag::where('id', $id)->where('slug', $slug)->first()->delete();

            return redirect('/tags')->with('success', 'Le tag a bien été supprimé');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour supprimer une catégorie');
    }
}
