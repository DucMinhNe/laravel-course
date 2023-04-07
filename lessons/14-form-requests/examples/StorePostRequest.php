<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    // Return false → 403 before the controller runs.
    public function authorize(): bool
    {
        return $this->user() !== null;   // e.g. only logged-in users
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
            'tags'  => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return ['title.required' => 'A post needs a title.'];
    }
}

// Controller usage:
//
//   public function store(StorePostRequest $request)
//   {
//       return Post::create($request->validated());
//   }
