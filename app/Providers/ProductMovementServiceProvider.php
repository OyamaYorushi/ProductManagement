<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductMovementService;
use App\Services\IProductMovementService;

class ProductMovementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProductMovementService::class, ProductMovementService::class);
    }
}
