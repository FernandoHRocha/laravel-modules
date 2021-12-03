<?php

namespace Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider{

     /**
     * Initialize function to system.
     *
     */
    public function boot() {
        $this->mapRoutes();
    }

     /**
     * Create group route protected.
     *
     * @internal Set prefix on the route.
     *
     */
    public function mapRoutes() {
        Route::prefix('auth')
            ->group(__DIR__.'/../Routes/routes.php');
    }
}
