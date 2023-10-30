<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class EventsStats extends Component
{
    public $class = '';

    #[Computed]
    public function events()
    {
        return auth()->user()->load('events')->events->count();
    }
}
