<?php

namespace NpTS\Domain\HelpDesk\Events;

use NpTS\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use NpTS\Domain\HelpDesk\Models\Question;


class UserCreatedAQuestion extends Event
{
    use SerializesModels;
    private $question;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
