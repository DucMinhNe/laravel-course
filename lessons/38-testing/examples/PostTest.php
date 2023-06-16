<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;   // fresh, rolled-back DB per test

    public function test_anyone_can_list_posts(): void
    {
        Post::factory()->count(3)->create();

        $this->getJson('/api/posts')
             ->assertOk()
             ->assertJsonCount(3, 'data');
    }

    public function test_authenticated_user_can_create_a_post(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->postJson('/api/posts', ['title' => 'Hello', 'body' => 'World'])
             ->assertCreated();                       // 201

        $this->assertDatabaseHas('posts', ['title' => 'Hello']);
    }

    public function test_title_is_required(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->postJson('/api/posts', ['body' => 'no title'])
             ->assertStatus(422)
             ->assertJsonValidationErrors('title');
    }

    public function test_guest_is_rejected(): void
    {
        $this->postJson('/api/posts', ['title' => 'x'])->assertUnauthorized(); // 401
    }
}
