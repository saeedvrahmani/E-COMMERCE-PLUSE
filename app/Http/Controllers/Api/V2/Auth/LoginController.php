<?php

namespace App\Http\Controllers\Api\V2\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V2\Auth\LoginRequest;
use LaravelJsonApi\Core\Document\Error;
use Modules\User\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request): Response|Error
    {
        $client = User::where('email', $request->email)->first();
//dd();
//        $client = DB::table('oauth_clients')->where('password_client', 1)->first();
//
//        $request = Request::create(config('app.url') . '/oauth/token', 'POST', [
//            'grant_type'    => 'password',
//            'client_id'     => $client->id,
//            'client_secret' => $client->secret,
//            'username'      => $request->email,
//            'password'      => $request->password,
//            'scope'         => '',
//        ]);
//
//        /** @var \Illuminate\Http\Response $response */
//        $response = app()->handle($request);
//
//        if ($response->getStatusCode() !== Response::HTTP_OK) {
//            return Error::fromArray([
//                'title'  => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
//                'detail' => $response->exception->getMessage(),
//                'status' => Response::HTTP_BAD_REQUEST,
//            ]);
//        }
        if (!$client) {
            return response()->json([
                'message' => 'Credentials are incorrect'
            ], 401);
        }

        $token = $client->createToken('ReactSPA')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'roles' => $client->getRoleNames()->toArray(),
            'user' => $client,
            'permissions' => $client->getAllPermissions()->pluck('name'),
            'token_type' => 'Bearer',
        ]);
    }
}
