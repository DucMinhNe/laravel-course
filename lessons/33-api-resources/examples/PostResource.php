<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'slug'      => $this->slug,
            'published' => (bool) $this->published,
            // Only include the author if it was eager-loaded (->with('user'))
            'author'    => new UserResource($this->whenLoaded('user')),
            // Only include body in the single-item view, not list views
            'body'      => $this->when($request->routeIs('posts.show'), $this->body),
            'createdAt' => $this->created_at?->toIso8601String(),
        ];
    }
}

// Controller usage:
//   return PostResource::collection(Post::with('user')->paginate(15));
//   return new PostResource($post->load('user'));
