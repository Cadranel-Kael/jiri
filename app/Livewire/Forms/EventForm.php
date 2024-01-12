<?php

namespace App\Livewire\Forms;

use App\Events\EventStartedEvent;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{
    use AuthorizesRequests;

    public ?Event $event;

    #[Validate('required|min:3', as: 'form.name')]
    public $name;

    #[Validate('required|date', as: 'form.date')]
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

    public function start()
    {
        $this->status = 'started';
        $this->event->update($this->all());
        foreach ($this->event->participants as $participant) {
            $participant->update(['token' => md5(rand(1, 10) . microtime())]);
        }
        EventStartedEvent::dispatch($this->event);
    }

    public function addProject($project_id, $weight)
    {
        $this->authorize('handleProject', [$this->event, Project::find($project_id)]);

        if ($weight < 0 || $weight === null) {
            $weight = 1;
        }

        $this->event->projects()->attach($project_id, ['weight' => $weight]);

        if (isset($this->event->students)) {
            foreach ($this->event->students as $student) {
                $student->projects()->attach($project_id, ['event_id' => $this->event->id]);
            }
        }

        session()->now('success', __('events.project_added'));
    }

    public function removeProject($project_id)
    {
        $this->authorize('update', $this->event);

        $this->event->projects()->detach($project_id);
        $this->event->students()->detach($project_id);
    }

    public function updateProject($project_id, $weight)
    {
        $this->authorize('update', $this->event);

        $this->event->projects()->updateExistingPivot($project_id, ['weight' => $weight]);
    }

    public function addEvaluator($evaluator_id)
    {
        $this->authorize('handleContact', [$this->event, Contact::find($evaluator_id)]);

        $this->event->evaluators()->attach($evaluator_id, ['role' => 'evaluator']);
    }

    public function removeEvaluator($evaluator_id)
    {
        $this->authorize('update', $this->event);

        $this->event->evaluators()->detach($evaluator_id);
    }

    public function addStudent($student_id)
    {
        $this->authorize('handleContact', [$this->event, Contact::find($student_id)]);

        $this->event->students()->attach($student_id, ['role' => 'student']);
    }

    public function removeStudent($student_id)
    {
        $this->authorize('update', $this->event);

        $this->event->students()->detach($student_id);
    }

    public function addPresentation($student_id, $project_id)
    {
        $this->event->presentations()->attach($student_id, ['project_id' => $project_id]);
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
        $this->authorize('update', $this->event);

        if ($this->event->status !== null) {
            session()->flash('error', __('error.event_over'));
            return;
        }
        $this->validate();

        $this->event->update($this->all());
    }

    public function destroy()
    {
        $this->authorize('delete', $this->event);

        $this->event->delete();
    }
}
