<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Ramsey\Collection\Collection;


class SingleEvent extends Component
{
    use Searchable;

    public EventForm $form;

    public $editMode = false;

    public int $id;

    public $projectIds = [];

    public $editingUrls = [];

    public $projects;
    public $weight = [];


    public function mount()
    {
        $this->form->setEvent(auth()->user()->events()->where('id', $this->id)->first());
        $this->updateProjects();
    }

    public function updateProjects()
    {
        $this->projects = [];
        foreach (auth()->user()->events()->where('id', $this->id)->first()->projects as $project) {
            $this->projects[] = $project;
            $this->weight[$project->id] = $project->pivot->weight;
        }
    }

    public function toggleEditMode()
    {
        $this->editMode = true;
    }

    public function cancel()
    {
        $this->editMode = false;
        $this->form->reset();
        $this->form->setEvent(auth()->user()->events()->where('id', $this->id)->first());
        $this->updateProjects();
    }

    public function changeProjectOrder(): void
    {
        $this->projectOrder = $this->projectOrder === 'ASC' ? 'DESC' : 'ASC';
    }

    #[Computed]
    public function event()
    {
        return auth()->user()->events()->where('id', $this->id)->first();
    }

    public function startEvent()
    {
        $this->form->start();

        session()->flash('success', __('events.event_started'));

        $this->redirect(route('events.show', $this->id));
    }

    #[Computed]
    public function eventProjects()
    {
        return $this->event()->projects;
    }

    public function addProjects()
    {
        foreach ($this->addedProjectsIds as $id) {
            $this->form->addProject($id, 1);
        }

        $this->updateProjects();

        session()->flash('success', __('events.projects_added'));

        $this->redirect(route('events.show', $this->id));
    }

    public function removeProject($id)
    {
        $this->form->removeProject($id);

        $this->updateProjects();

        $this->dispatch('flash', message: 'events.project_removed', type: 'success');
    }

    // ----------------
    // -- Evaluators --
    // ----------------

    #[Computed]
    public function evaluators()
    {
        return $this->event->evaluators;
    }

    public function removeEvaluator($id)
    {
        $this->form->removeEvaluator($id);

        session()->flash('success', __('events.evaluator_removed'));

        $this->redirect(route('events.show', $this->id));
    }

    // --------------
    // -- Students --
    // --------------

    #[Computed]
    public function students()
    {
        return $this->event->students()->whereHas('presentations', function (Builder $query) {
            $query->where('event_id', $this->event->id);
        })->with(['presentations' => function ($query) {
            $query->where('event_id', $this->event->id);
        }])->get();
    }

    public function removeStudent($id)
    {
        $this->form->removeStudent($id);

        session()->flash('success', __('events.student_removed'));

        $this->redirect(route('events.show', $this->id));
    }

    public function toggleEditUrls($presentation_id)
    {
        if (isset($this->editingUrls[$presentation_id])) {
            unset($this->editingUrls[$presentation_id]);
        } else {
            $this->editingUrls[$presentation_id] = $this->event->presentations()->where('id', $presentation_id)->first()->urls;
        }
    }

    public function updateUrls($presentation_id)
    {
        $this->event->presentations()->where('id', $presentation_id)->update(['urls' => $this->editingUrls[$presentation_id]]);

        unset($this->editingUrls[$presentation_id]);
    }


    public function presentations($contactId)
    {
        return $this->event->presentations()->where('contact_id', $contactId)->get();
    }


    public function matchingTasks($projectTasks, $tasks)
    {
        foreach ($tasks as $task) {
            $matches[] = array_search($task, $projectTasks);
        }

        return $matches;
    }

    public function start()
    {

    }

    public function update()
    {
        $this->form->update();

        foreach ($this->projects as $project) {
            $this->form->updateProject($project->id, $this->weight[$project->id]);
        }

        $this->editMode = false;

        $this->dispatch('flash', message: 'events.event_updated', type: 'success');
    }

    public
    function render()
    {
        return view('livewire.single-event');
    }
}
