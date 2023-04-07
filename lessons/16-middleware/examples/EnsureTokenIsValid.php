<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        // --- BEFORE the request reaches the route ---
        if ($request->header('X-Token') !== config('app.api_token')) {
            abort(401, 'Invalid token.');
        }

        $response = $next($request);   // hand off to the next layer

        // --- AFTER the route produced a response ---
        $response->headers->set('X-Checked', 'true');

        return $response;
    }
}

// 1) Register an alias in app/Http/Kernel.php:
//      protected $middlewareAliases = [
//          'token' => \App\Http\Middleware\EnsureTokenIsValid::class,
//      ];
//
// 2) Apply to a route:
//      Route::get('/private', fn () => 'secret')->middleware('token');
