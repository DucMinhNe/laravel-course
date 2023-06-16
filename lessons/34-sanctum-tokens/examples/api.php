<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

// Issue a token in exchange for valid credentials
Route::post('/tokens', function (Request $request) {
    $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
        'device'   => ['required', 'string'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Optional abilities (scopes) as the 2nd arg
    return ['token' => $user->createToken($request->device, ['posts:read'])->plainTextToken];
});

// Protected by a valid bearer token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn (Request $request) => $request->user());

    Route::get('/posts', function (Request $request) {
        abort_unless($request->user()->tokenCan('posts:read'), 403);
        return \App\Models\Post::all();
    });

    // Revoke the token used for the current request (logout)
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    });
});
