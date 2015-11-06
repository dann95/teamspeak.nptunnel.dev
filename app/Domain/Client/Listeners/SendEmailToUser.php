<?php

namespace NpTS\Domain\Client\Listeners;

use NpTS\Domain\Client\Events\UserWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmailToUser
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
        Mail::send('emails.userCreated', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject($user->name.' Seja bem vindo a GameSpeak!');
            $m->from('norepply@gamespeak.com.br' , 'GameSpeak');
        });
    }
}
