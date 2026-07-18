<?php

namespace App\View\composer;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AdminComposer
{
public function compose(View $view)
{
    $view->with([
        'categories' => Category::whereisRoot() ->with('children')->gat(['category_name', 'category_id']),
    ]);
}
public function menu_count(View $view)
{
    $menu_count = Cache::remember('menu_count', 10, function (){

    });
}
}
