<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryEloquent;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * - Usamos para configurar o Repository Pattern 
     * - Com as duas classes para fazer o Pattern certo
     * 
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            OrderRepository::class, OrderRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * - Usamos o metodo observe para o observer funcionar
         */
        User::observe(UserObserver::class);
    }
}
