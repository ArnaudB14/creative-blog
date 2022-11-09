<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Status;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $statuses = Status::all();
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::latest()->paginate(5);

        $posts = Post::where([
            [function ($query) use ($request) {
                if(($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->orWhere('description', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->latest()->paginate(5);

        // return view('pages.home', ['posts' => collect()]);
        return view('pages.home', ['posts' => $posts, 'statuses' => $statuses, 'categories' => $categories, 'tags' => $tags])->with('i', (request()->input('page', 1)-1) * 5);
    }

}
