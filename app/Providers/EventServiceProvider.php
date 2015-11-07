<?php

namespace NpTS\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'NpTS\Domain\Client\Events\UserWasCreated' => [
            'NpTS\Domain\Client\Listeners\CreateActivationKey',
            'NpTS\Domain\Client\Listeners\SendEmailToUser',
        ],
        'NpTS\Domain\HelpDesk\Events\UserCreatedAQuestion' => [
            'NpTS\Domain\HelpDesk\Listeners\SendEmailToUser'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
