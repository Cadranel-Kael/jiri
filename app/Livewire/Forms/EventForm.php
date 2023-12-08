<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Presentation;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{
    public ?Event $event;

    #[Validate('required|min:3')]
    public $name;

    #[Validate('required|date')]
    public $date;

    public $duration;

    public $status;


    public function setEvent(Event $event)
    {
        $this->event = $event;

        $this->name = $event->name;

        $this->date = $event->date;

        $this->duration = $event->duration;

        $this->status = $event->status;
    }

    public function addProject($project_id, $weight)
    {
        $this->event->projects()->attach($project_id, ['weight' => $weight]);
    }

    public function removeProject($project_id)
    {
        $this->event->projects()->detach($project_id);
    }

   public function addEvaluator($evaluator_id)
    {
        $this->event->evaluators()->attach($evaluator_id, ['role' => 'evaluator']);
    }

    public function removeEvaluator($evaluator_id)
    {
        $this->event->evaluators()->detach($evaluator_id);
    }

    public function addStudent($student_id)
    {
        $this->event->students()->attach($student_id, ['role' => 'student']);
    }

    public function removeStudent($student_id)
    {
        $this->event->students()->detach($student_id);
    }


    public function store()
    {
        $this->validate();

        $this->event = Auth::user()
            ->events()
            ->save(new Event($this->only('name', 'date')));

    }

    public function update()
    {
        $this->validate();

        $this->event->update($this->all());
    }

    public function destroy()
    {
        $this->event->delete();
    }
}