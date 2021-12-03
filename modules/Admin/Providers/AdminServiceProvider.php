<?php

namespace Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {

    /**
     * Define your route model bindings, pattern filters, etc.
     * 
     * @return void
     */
    public function boot() {
        $this->mapRoutes();
    }

    /**
     * Criação de rotas protegidas
     * 
     * @internal Configura o prefixo da rota
     */
    public function mapRoutes() {
        Route::prefix('admin')
            ->group(__DIR__.'/../Routes/routes.php');
    }

}