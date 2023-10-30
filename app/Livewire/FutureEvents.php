<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FutureEvents extends Component
{
    public $class = '';

    #[Computed]
    public function events()
    {
        return auth()->user()->load('events')->events->where('date', '>=', Carbon::today()->toDateString());
    }
}
