<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next , $role=[] ): Response
    {
        $user = User::where('email',$request->email)->first();

        if (!$user || !$user->getRoleNames()) {
        return abort(403, 'Sorry Access Denied !');
        }
            return $next($request);
    }
}
