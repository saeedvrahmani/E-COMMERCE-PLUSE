<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Models\User;
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
