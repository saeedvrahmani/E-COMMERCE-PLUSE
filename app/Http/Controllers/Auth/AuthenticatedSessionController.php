<?php

namespace App\Http\Controllers\Auth;


use App\Http\Middleware\CheckRole;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware(CheckRole::class);
//    }

    public function showLogin(): View
    {

        return view('auth._login');
    }

    public function storeUser(LoginRequest $request): \Illuminate\Routing\Redirector|RedirectResponse
    {

        $request->authenticate();


        $request->session()->regenerate();
        if (\auth()->user()->getRoleNames()->count()){
            return redirect()->route('dashboard');
        }
        return redirect()->intended('/');


    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
