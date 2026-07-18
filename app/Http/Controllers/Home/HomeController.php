<?php

namespace App\Http\Controllers\Home;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index():View
    {

        return view('home.app');
    }
}
