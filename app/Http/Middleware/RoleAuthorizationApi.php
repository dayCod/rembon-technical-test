<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Response\JsonApiResponse;

class RoleAuthorizationApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::user()->role !== $role) {
            return JsonApiResponse::unauthorized('Your Current Role:'.$role.' is Unauthorized', []);
        }
        return $next($request);
    }
}
