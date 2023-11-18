<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleContact extends Component
{
    public int $id;

    #[Computed]
    public function contact()
    {
        return auth()->user()->contacts()->where('id', $this->id)->first();
    }

    #[Computed]
    public function events()
    {
        return $this->contact()->events->load('projects')->load('presentations');
    }

    public function getProjectAverage($event_id, $project_id, $total = 100)
    {
        return round($this
            ->events
            ->where('id', $event_id)
            ->first()
            ->presentations()
            ->where('project_id', $project_id)
            ->first()
            ->scores
            ->pluck('score')
            ->avg()/100*$total);
    }

    public function getAverage($event_id, $total = 100)
    {
        foreach ($this->events->where('id', $event_id)->first()->projects as $project) {
            $scores[] = $this->getProjectAverage($event_id, $project->id)*$project->pivot->weight;
        }

        return round(array_sum($scores)/count($scores)/100*$total);
    }

    public function render()
    {
        return view('livewire.single-contact');
    }
}
