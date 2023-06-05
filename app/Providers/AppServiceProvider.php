<?php

namespace App\Providers;

use App\Repositories\SearchTaskRepository;
use App\Services\ClientsFinder;
use App\Services\VkApi;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(fn() => Password::min(8)->mixedCase()->letters()->numbers());
    }

    public array $singletons = [
        VkApi::class => VkApi::class,
        ClientsFinder::class => ClientsFinder::class,
        SearchTaskRepository::class => SearchTaskRepository::class
    ];
}
