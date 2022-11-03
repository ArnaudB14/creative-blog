<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $posts = Post::latest()->paginate(5);
        // return view('pages.home', ['posts' => collect()]);
        return view('pages.home', ['posts' => $posts]);
    }
}
