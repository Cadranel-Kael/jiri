<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleEvent extends Component
{
    public EventForm $form;

    public int $id;

    public $projectSearch = '';
    public string $projectSort = 'title';
    public string $projectOrder = 'ASC';
    public array $projectSortables = ['title', 'created_at'];
    public array $addedProjectsIds = [];

    public $editingUrls = [];

    public function mount()
    {
        $this->form->setEvent(auth()->user()->events()->where('id', $this->id)->first());
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

    // --------------
    // -- Projects --
    // --------------

    #[Computed]
    public function projects()
    {
        return auth()
            ->user()
            ->projects()
            ->where('title', 'like', '%' . $this->projectSearch . '%')
            ->whereNotIn('id', $this->event->projects->pluck('id'))
            ->whereNotIn('id', $this->addedProjectsIds)
            ->orderBy($this->projectSort, $this->projectOrder)
            ->paginate(12);
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()
            ->user()
            ->projects()
            ->where('title', 'like', '%' . $this->projectSearch . '%')
            ->whereIn('id', $this->addedProjectsIds)
            ->whereNotIn('id', $this->event->projects->pluck('id'))
            ->orderBy($this->projectSort, $this->projectOrder)
            ->paginate(12);
    }

    #[Computed]
    public function eventProjects()
    {
        return $this->event()->projects;
    }

    public function addProjectId($id)
    {
        if (!in_array($id, $this->addedProjectsIds) && auth()->user()->projects()->where('id', $id)->exists()) {
            $this->addedProjectsIds[] = $id;
        }
    }

    public function removeProjectId($id)
    {
        if (in_array($id, $this->addedProjectsIds)) {
            $this->addedProjectsIds = array_diff($this->addedProjectsIds, [$id]);
        }
    }

    public function addProjects()
    {
        foreach($this->addedProjectsIds as $id) {
            $this->form->addProject($id, 1);
        }

        $this->addedProjectsIds = [];

        session()->flash('success', __('events.projects_added'));

        $this->redirect(route('events.show', $this->id));
    }

    public function removeProject($id)
    {
        $this->form->removeProject($id);

        session()->flash('success', __('events.project_removed'));

        $this->redirect(route('events.show', $this->id));
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
        foreach ($tasks as $task)
        {
            $matches[] = array_search($task, $projectTasks);
        }

        return $matches;
    }

    public function start()
    {

    }


    public function render()
    {
        return view('livewire.single-event');
    }
}
