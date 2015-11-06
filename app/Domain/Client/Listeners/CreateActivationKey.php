<?php

namespace NpTS\Domain\Client\Listeners;

use NpTS\Domain\Client\Events\UserWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateActivationKey
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        $user = $event->getUser();
        $user->active = 0;
        $user->activation_key = md5(rand().$user->email.rand());
        $user->save();
    }
}
