<?php

namespace NpTS\Domain\Admin;

use Illuminate\Support\ServiceProvider;
use NpTS\Domain\Admin\Repositories\ServerRepository;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;


class AdminServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServerRepositoryContract::class , ServerRepository::class);
    }
}
