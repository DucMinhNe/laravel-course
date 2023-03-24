<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // GET /posts
    public function index()
    {
        return Post::latest()->get();
    }

    // GET /posts/{post}  — route model binding resolves the model
    public function show(Post $post)
    {
        return $post;
    }

    // POST /posts
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = Post::create($data);

        return response()->json($post, 201);
    }
}
