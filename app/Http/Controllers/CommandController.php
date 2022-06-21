<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function cache()
    {
        Artisan::call('cache:clear');
        dd('cache clear');
    }

    public function config()
    {
        Artisan::call('config:clear');
        dd('config clear');
    }

    public function route()
    {
        Artisan::call('route:cache');
        dd('route cache');
    }

    public function routeClear()
    {
        Artisan::call('route:clear');
        dd('route cache clear');
    }

    public function storage()
    {
        Artisan::call('storage:link');
        dd('storage link established');
    }
}
