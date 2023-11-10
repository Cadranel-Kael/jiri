<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleEvent extends Component
{

    public int $id;

    #[Computed]
    public function event()
    {
        return auth()->user()->events()->where('id', $this->id)->first();
    }


    #[Computed]
    public function evaluators()
    {
        return $this->event->evaluators;
    }

    #[Computed]
    public function students()
    {
        return $this->event->students;
    }

    public function render()
    {
        return view('livewire.single-event');
    }
}
