<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    // Variadic params come from middleware('role:admin,editor')
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        abort_unless(
            $request->user() && in_array($request->user()->role, $roles, true),
            403,
            'Insufficient role.'
        );

        return $next($request);
    }

    // Runs AFTER the response is sent to the browser (logging, metrics).
    public function terminate(Request $request, Response $response): void
    {
        logger()->info('role-check', [
            'path'   => $request->path(),
            'status' => $response->getStatusCode(),
        ]);
    }
}

// Kernel alias:  'role' => \App\Http\Middleware\EnsureRole::class,
// Route:         ->middleware('role:admin,editor')
