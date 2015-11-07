<?php

namespace NpTS\Domain\HelpDesk\Listeners;

use NpTS\Domain\HelpDesk\Events\UserCreatedAQuestion;
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
     * @param  UserCreatedAQuestion  $event
     * @return void
     */
    public function handle(UserCreatedAQuestion $event)
    {
        $user = $event->getQuestion()->user;
        $question = $event->getQuestion();
        Mail::send('emails.questionCreated', ['user' => $user , 'question' => $question], function ($m) use ($user , $question) {
            $m->to($user->email, $user->name)->subject($user->name.' recebemos o ticket de suporte de numero #'.$question->id);
            $m->from('norepply@gamespeak.com.br' , 'GameSpeak');
        });
    }
}
