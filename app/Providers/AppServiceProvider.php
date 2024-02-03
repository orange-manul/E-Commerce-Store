<?php

namespace App\Providers;

use App\Service\Admin\CategoryService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(CategoryService::class, function ($app){
            return new CategoryService();
        });
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
