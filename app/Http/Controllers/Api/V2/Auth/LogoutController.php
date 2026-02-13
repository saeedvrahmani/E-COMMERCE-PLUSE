<?php

namespace App\Http\Controllers\Api\V2\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{

    public function __invoke(Request $request): Response
    {
        $user = auth()->user();
        if ($user) {
            $user->tokens()->delete();
        }

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
