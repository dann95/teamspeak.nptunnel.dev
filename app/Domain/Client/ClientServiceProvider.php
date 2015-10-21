<?php

namespace NpTS\Domain\Client;

use Illuminate\Support\ServiceProvider;

use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use NpTS\Domain\Client\Repositories\VirtualServerRepository;

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
    }
}
