<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return $this->unauthorizedResponse(
                $request,
                'Unauthorized',
                401
            );
        };
        
        if (!in_array($user->role->role_code, $roles)) {
            return $this->unauthorizedResponse(
                $request,
                'You do not have the required role.',
                403
            );
        }

        return $next($request);
    }

    protected function unauthorizedResponse(Request $request, string $message, int $status)
    {
        // API → JSON
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $message,
            ], $status);
        }

        // Web → HTML
        abort($status, $message);
    }
}
