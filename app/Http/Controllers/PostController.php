<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index (Request $request)
    {
        $user = $request->user();
        $posts = $user->posts;

        return view('dashboard', [
            'posts' => $posts
        ]);
    }

    public function show (Request $request, Post $post)
    {
        return $post;
    }

    public function edit (Request $request, Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update (Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'image' => 'required|file|mimes:jpg,png,gif',
            'content' => 'required|string|max:3000'
        ]);

        $path = $request->file('image')->store('public/uploads');
        $post->content = $validatedData['content'];
        $path = str_replace('public/', 'storage/', $path);
        $path = "/{$path}";
        $path = str_replace('//', '/', $path);
        $post->image = $path;
        $post->save();

        return redirect()->route('posts.index');
    }
}
