<?php

namespace App\Events;

use App\Models\Event;
use Illuminate\Foundation\Events\Dispatchable;

class EventStartedEvent
{
    use Dispatchable;

    public function __construct(
        public Event $event
    )
    {

    }
}
