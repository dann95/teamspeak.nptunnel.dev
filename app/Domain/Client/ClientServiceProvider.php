<?php

namespace NpTS\Domain\Client;

use Illuminate\Support\ServiceProvider;

use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use NpTS\Domain\Client\Repositories\VirtualServerRepository;

use NpTS\Domain\Client\Cart\Cart;
use NpTS\Domain\Client\Cart\Contract\CartContract;

class ClientServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VirtualServerRepositoryContract::class , VirtualServerRepository::class);
        $this->app->bind(CartContract::class , Cart::class);
    }
}
