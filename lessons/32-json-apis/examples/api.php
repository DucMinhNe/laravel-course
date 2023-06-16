<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\TaskController;

// All routes here are prefixed with /api automatically.

// Option A — full CRUD in one line (5 routes, no create/edit form pages)
Route::apiResource('tasks', TaskController::class);

// Option B — hand-written, showing the status codes
Route::get('/ping', fn () => ['pong' => true]);

Route::post('/notes', function (Request $request) {
    $data = $request->validate([
        'title' => ['required', 'string', 'max:255'],
    ]);

    $note = Task::create($data);

    return response()->json($note, 201);   // 201 Created
});

Route::delete('/notes/{note}', function (Task $note) {
    $note->delete();
    return response()->noContent();         // 204 No Content
});
