<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Status;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $statuses = Status::all();
        $posts = Post::latest()->paginate(5);
        // return view('pages.home', ['posts' => collect()]);
        return view('pages.home', ['posts' => $posts], ['statuses' => $statuses]);
    }
}
