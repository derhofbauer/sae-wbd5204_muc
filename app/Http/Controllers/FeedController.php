<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{

    public function feed (Request $request)
    {
        $posts = Post::ordered()->paginate(5);

        return view('feed', [
            'posts' => $posts,
            'heading' => __('Feed')
        ]);
    }

    public function api (Request $request)
    {
        $posts = Post::ordered()->with('author')->paginate(5);

        return response()->json($posts);
    }

}
