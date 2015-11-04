<?php

namespace NpTS\Domain\HelpDesk;

use Illuminate\Support\ServiceProvider;

use NpTS\Domain\HelpDesk\Repositories\Contracts\QuestionRepositoryContract;
use NpTS\Domain\HelpDesk\Repositories\QuestionRepository;

class HelpDeskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(QuestionRepositoryContract::class , QuestionRepository::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
