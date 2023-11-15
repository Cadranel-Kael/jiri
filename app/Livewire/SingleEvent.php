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

    public function getParticipations($contactId)
    {
        return $this->event->participations()->where('contact_id', $contactId)->get();
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
