<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $this->postService->createPost($request->all());

        return response()->json(['message' => 'Post created successfully', 'data' => $post], 201);
    }

    public function show(Post $post)
    {
        return response()->json(['data' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->postService->updatePost($post, $request->all());

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return response()->json(null, 204);
    }
    
}
