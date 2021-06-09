<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index (Request $request, User $user)
    {
        $heading = __('Profile');
        if (!$user->exists) {
            $user = $request->user();
        } else {
            $heading = __('Profile: ' . $user->name);
        }
        $posts = $user->posts()->ordered()->paginate(15);

        return view('feed', [
            'posts' => $posts,
            'heading' => $heading
        ]);
    }

    public function show (Request $request, Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
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
        $validatedData = $this->validatePostForm($request);

        $path = self::handleUploadedFile($request);
        $post->content = $validatedData['content'];
        $post->image = $path;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function create (Request $request)
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    public function store (Request $request)
    {
        $validatedData = $this->validatePostForm($request);

        $path = self::handleUploadedFile($request);
        $post = new Post($validatedData);
        $post->image = $path;
        $post->user_id = $request->user()->id;
        $post->save();

        return redirect()->route('posts.index');
    }

    private function validatePostForm (Request $request)
    {
        return $request->validate([
            'image' => 'required|file|mimes:jpg,png,gif',
            'content' => 'required|string|max:3000'
        ]);
    }

    /**
     * @param Request $request
     *
     * @return array|false|string|string[]
     */
    public static function handleUploadedFile (Request $request)
    {
        $path = $request->file('image')->store('public/uploads');
        $path = str_replace('public/', 'storage/', $path);
        $path = "/{$path}";
        return str_replace('//', '/', $path);
    }
}
