<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService(new Category());
        });
    }
}
