<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->event->students()->whereHas('presentations', function (Builder $query) {
            $query->where('event_id', $this->event->id);
        })->with(['presentations' => function ($query) {
            $query->where('event_id', $this->event->id);
        }])->get();
    }

    public function presentations($contactId)
    {
        return $this->event->presentations()->where('contact_id', $contactId)->get();
    }


    public function matchingTasks($projectTasks, $tasks)
    {
        foreach ($tasks as $task)
        {
            $matches[] = array_search($task, $projectTasks);
        }

        return $matches;
    }

    public function render()
    {
        return view('livewire.single-event');
    }
}
