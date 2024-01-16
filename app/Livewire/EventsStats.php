<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class EventsStats extends Component
{
    public $class;

    #[Computed]
    public function events()
    {
        return auth()->user()->events()->where('status', 'ended');
    }

    #[Computed]
    public function passes()
    {
        $passCount = 0;

        foreach (auth()->user()->events()->get() as $event) {
            $passCount += $event->summaries()->where('score', '>=', 50)->count();
        }

        return $passCount;
    }
}
