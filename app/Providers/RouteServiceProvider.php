<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->removeIndexPHPFromURL();

        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected function removeIndexPHPFromURL()
    {
        // dd(request()->url());
        if (Str::contains(request()->getRequestUri(), '/index.php/')) {
            $url = str_replace('/index.php/', '', request()->getRequestUri());
            $url = env('APP_URL') . $url;
            header("Location: $url", true, 301);
            exit;
        }
        if (Str::contains(request()->getRequestUri(), '/index.php')) {
            $url = str_replace('/index.php', '', request()->getRequestUri());
            $url = env('APP_URL') . $url;
            header("Location: $url", true, 301);
            exit;
        }
        // if url contain www
        if (Str::contains(request()->url(), 'www.')) {
            $url = str_replace('www.', '', request()->url());
            header("Location: $url", true, 301);
            exit;
        }
    }
}
