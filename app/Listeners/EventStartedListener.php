<?php

namespace App\Listeners;

use App\Events\EventStartedEvent;
use App\Jobs\SendTokenToEvaluatorJob;

class EventStartedListener
{
    public function __construct()
    {
    }

    public function handle(EventStartedEvent $event): void
    {
        SendTokenToEvaluatorJob::dispatch($event->event);
    }
}
