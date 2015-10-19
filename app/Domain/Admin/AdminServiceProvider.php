<?php

namespace NpTS\Domain\Admin;

use Illuminate\Support\ServiceProvider;

use NpTS\Domain\Admin\Repositories\ServerRepository;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;

use NpTS\Domain\Admin\Repositories\PlanRepository;
use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;

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
        $this->app->bind(PlanRepositoryContract::class , PlanRepository::class);
    }
}
