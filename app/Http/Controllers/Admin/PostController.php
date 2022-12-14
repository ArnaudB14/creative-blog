<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Tag;
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
            $posts = Post::with(['category', 'status'])->latest()->paginate(7);
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
            $tags = Tag::all();
            $categories = Category::all();
            $statuses = Status::all();
            return view('admin.posts.create', ['categories' => $categories, 'statuses' => $statuses, 'tags' => $tags]);
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
            
            // UPLOAD IMAGE
            
            if(isset($request->file_path)) {
                $imageName = Str::uuid() . '.' . $request->file_path->extension();
                $request->file_path->move(public_path('images'), $imageName);
                $validatedData['file_path'] = $imageName;

                $post = Post::create([
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'category_id' => $validatedData['category_id'],
                    'status_id' => $validatedData['status_id'],
                    'file_path' => $validatedData['file_path'],
                ]);
            }
           

            else {
                $post = Post::create([
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'category_id' => $validatedData['category_id'],
                    'status_id' => $validatedData['status_id'],
                ]);
            };

            $post->tag()->attach($request->tag_id);

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
    public function show($id, $slug) 
    {   
        $tags = Post::find($id)->tag();
        $comments = Comment::where('post_id', $id)->get();
        $post = Post::where('id', $id)->where('slug', $slug)->firstOrFail();
        
        return view('admin.posts.show', ['post' => $post, 'comments' => $comments, 'tags' => $tags]);
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
            $categories = Category::all();
            $statuses = Status::all();
            $tags = Tag::all();
            $posts = Post::where('id', $id)->where('slug', $slug)->first();
            return view('admin.posts.edit', ['posts' => $posts, 'categories' => $categories, 'statuses' => $statuses, 'tags' => $tags]);
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
    public function update(PostRequest $request, $id, $slug)
    {
        if (Auth::check()) {
           $validatedData = $request->validated();

           if(isset($request->file_path)) {

                $imageName = Str::uuid() . '.' . $request->file_path->extension();
                $request->file_path->move(public_path('images'), $imageName);
                $validatedData['file_path'] = $imageName;

                $post = Post::where('id', $id)->where('slug', $slug)->first()->update([
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'category_id' => $validatedData['category_id'],
                    'status_id' => $validatedData['status_id'],
                    'file_path' => $validatedData['file_path'],
                ]);
            }

            else {
                $post = Post::where('id', $id)->where('slug', $slug)->first()->update([
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'category_id' => $validatedData['category_id'],
                    'status_id' => $validatedData['status_id'],
                ]);
            };

            Post::find($id)->tag()->sync($request->tag_id);

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
    public function destroy($id, $slug)
    {

        if (Auth::check()) {
            if (Comment::exists()) {
                $comments = Comment::where('post_id', $id)->delete();
            }
            if (Tag::exists()) {
                $tags = Post::find($id)->tag()->detach();
            }
            $posts = Post::where('id', $id)->where('slug', $slug)->first()->delete();
            
            
            // $tags = Post::find($id)->tag()->delete();
            return redirect('/posts')->with('success', 'L\'article a bien été supprimé');
        }

        return redirect('/')->with('error', 'Vous devez être connecté pour supprimer un article');
    }
}
