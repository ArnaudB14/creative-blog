<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, $post_id)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            $post = Post::find($post_id);

            $comments = Comment::create([
                'content' => $validatedData['content'],
                'post_id' => $post_id,
                'user_id' => Auth::user()->id,
            ]);
            
            return redirect()->route('posts.show', [$post->id , $post->slug])->with('success', 'Commentaire ajouté');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour voir cette page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $comments = Comment::where('id', $id)->first();
            return view('comments.edit', ['comments' => $comments]);
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
    public function update(CommentRequest $request, $id)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();
 
            $comments = Comment::where('id', $id)->first()->update([
                'content' => $validatedData['content'],
            ]);
 
             return redirect('/account')->with('success', 'Commentaire modifié avec succès');
         }
 
         return redirect('/')->with('error', 'Vous devez être connecté pour modifier un commentaire');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $comments = Comment::where('id', $id)->first()->delete();

            return redirect('/account')->with('success', 'Le commentaire a bien été supprimé');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour supprimer un commentaire');
    }
}
