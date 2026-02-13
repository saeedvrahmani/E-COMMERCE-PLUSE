<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Modules\User\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {

    }

    public function adminLogin(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        $role = $user->getRoleNames()->first();
        if ($role !== 'customer') {
            $token = $user->createToken('react-dashboard');

            return response()->json([
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'role' => $user->getRoleNames()->first() ?? null,
            ]);
        }
        return response()->json(
            [
                'status' => 'error',
                'message' => 'entry failed',
            ]
        );
    }

    public function sendResetLink(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status' => 'success',
                'message' => __($status)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __($status)
        ], 400);
    }

//    public function resetPassword(Request $request): JsonResponse
//    {
//        $request->validate([
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => 'required|min:8|confirm',
//        ]);
//        $status = Password::reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'),
//            function (User $user, $password) {
//                $user->forceFill([
//                    'password' => bcrypt($password)
//                ])->save();
//            }
//        );
//        return $status === Password::PASSWORD_RESET
//            ? response()->json(['status' => 'success', 'message' => ' password change successfully'])
//            : response()->json(['status' => 'error', 'message' => 'token is invalid']);
//    }
}
