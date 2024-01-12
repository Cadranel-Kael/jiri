<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class PointsRecap extends Component
{
    public $event;

    #[Computed]
    public function participants()
    {
        return $this->event->participants()->get();
    }

    #[Computed]
    public function evaluators()
    {
        return $this->event->evaluators()->get();
    }

    #[Computed]
    public function students()
    {
        return $this->event->students()->get();
    }

    #[Computed]
    public function projects()
    {
        return $this->event->projects()->get();
    }

    public function presentations($student_id)
    {
        $presentations = $this->event->presentations()->where('contact_id', $student_id)->get();
        if ($presentations === null) {
            return '';
        }
        return $presentations;
    }

    public function score($presentation_id, $evaluator_id)
    {
        if ($presentation_id === null || $evaluator_id === null) {
            return '';
        }
        $score = $this->event->scores()->where('presentation_id', $presentation_id)->where('scores.contact_id', $evaluator_id)->first();
        if ($score === null) {
            return '';
        }
        return $score->score;
    }

    public function render()
    {
        return view('livewire.points-recap');
    }
}
