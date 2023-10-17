<?php

namespace App\Providers;

use App\Http\Controllers\Client\QuestionController;
use App\Http\Interface\CategoryInterface;
use App\Http\Interface\ClientInterface;
use App\Http\Interface\QuestionInterface;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\ClientRepository;
use App\Http\Repository\QuestionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientInterface::class,
            ClientRepository::class
        );
        $this->app->bind(
            QuestionInterface::class,
            QuestionRepository::class
        );
        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
