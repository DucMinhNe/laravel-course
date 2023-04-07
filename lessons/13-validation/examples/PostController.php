<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Throws ValidationException on failure:
        //  - web request  → redirect back with $errors
        //  - JSON request → 422 with {"message", "errors": {...}}
        $data = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'body'      => ['required', 'string'],
            'published' => ['boolean'],
            'tags'      => ['nullable', 'array'],
            'tags.*'    => ['string', 'max:30'],   // validate each array item
        ], [
            'title.required' => 'Every post needs a title.',  // custom message
        ]);

        // $data contains ONLY the validated keys — safe to mass-assign.
        return Post::create($data);
    }
}
