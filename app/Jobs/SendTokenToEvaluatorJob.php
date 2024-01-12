<?php

namespace App\Jobs;

use App\Mail\TokenMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTokenToEvaluatorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Event $event,
    )
    {
    }

    public function handle(): void
    {
        foreach ($this->event->evaluators as $evaluator)
        {
            Mail::to($evaluator)->send(new TokenMail($this->event->participants()->where('contact_id', $evaluator->id)->first()->token));
        }
    }
}
