<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskDatabaseTest extends TestCase
{
    use RefreshDatabase;   // fresh, rolled-back DB per test

    public function test_creating_a_task_persists_it(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/tasks', ['title' => 'Buy milk']);

        $this->assertDatabaseHas('tasks', [
            'title'   => 'Buy milk',
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseCount('tasks', 1);
    }

    public function test_deleting_soft_deletes(): void
    {
        $task = Task::factory()->create();

        $task->delete();

        $this->assertSoftDeleted($task);                 // deleted_at set
        $this->assertDatabaseHas('tasks', ['id' => $task->id]); // row still there
    }

    public function test_factory_relationships(): void
    {
        $user = User::factory()
            ->has(Task::factory()->count(3))
            ->create();

        $this->assertCount(3, $user->tasks);
    }
}
