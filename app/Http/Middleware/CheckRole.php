<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next  ): Response
    {

        if (auth()->check()) {
            if (auth()->user()->getRoleNames()->count()) {
                return $next($request);
            }
        }
        return abort(404);
    }
}
