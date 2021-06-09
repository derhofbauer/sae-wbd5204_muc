<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request, User $user)
    {
        if (!$user->exists) {
            $user = $request->user();
        }
        $posts = $user->posts()->with('author')->ordered()->paginate(15);

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|file|image',
            'content' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $path = PostController::handleUploadedFile($request);
        $post = new Post($request->all());
        $post->image = $path;
        $post->user_id = $request->user()->id;
        $post->save();

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show (Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post                     $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $post->content = $request->all()['content'];
        $post->save();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy (Post $post)
    {
        $post->delete();

        return response(null, 204);
    }
}
