<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// A minimal hand-rolled login (Breeze generates a nicer version of this).
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();              // anti session-fixation
        return redirect()->intended('/dashboard');       // back to where they were
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

// Protect routes — guests get bounced to the login page.
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn (Request $r) => 'Hi ' . $r->user()->name);
});
