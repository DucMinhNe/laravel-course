<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, actingAs};
use Illuminate\Foundation\Testing\RefreshDatabase;

// Apply a trait to every test in this file
uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('lists tasks', function () {
    Task::factory()->count(3)->create();

    getJson('/api/tasks')
        ->assertOk()
        ->assertJsonCount(3, 'data');
});

it('creates a task', function () {
    actingAs($this->user)
        ->postJson('/api/tasks', ['title' => 'Write Pest tests'])
        ->assertCreated();

    expect(Task::where('title', 'Write Pest tests')->exists())->toBeTrue();
});

it('requires a title', function () {
    actingAs($this->user)
        ->postJson('/api/tasks', [])
        ->assertStatus(422)
        ->assertJsonValidationErrors('title');
});

// Parameterised with a dataset
it('rejects short titles', function (string $title) {
    actingAs($this->user)->postJson('/api/tasks', ['title' => $title])->assertStatus(422);
})->with(['', 'a']);
