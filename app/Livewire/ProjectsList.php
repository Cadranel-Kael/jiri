<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use App\Traits\Searchable;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsList extends Component
{
    use Searchable;

    public $event;

    public EventForm $form;

    public $addedProjectsIds = [];

    public function mount(): void
    {
        $this->setSortables(['title', 'created_at']);
        $this->form->setEvent($this->event);
    }

    #[Computed]
    public function projects()
    {
        return auth()
            ->user()
            ->projects()
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->whereNotIn('id', $this->event->projects->pluck('id')->toArray())
            ->orderBy($this->sort, $this->order)
            ->paginate(12);
    }

    public function addProject($projectId)
    {
        $this->addedProjectsIds[] = $projectId;

    }

    public function removeProject($projectId)
    {
        $this->addedProjectsIds = array_diff($this->addedProjectsIds, [$projectId]);
    }

    public function add()
    {
        if ($this->addedProjectsIds) {
            foreach ($this->addedProjectsIds as $projectId) {
                $this->form->addProject($projectId, 1);
            }

            $this->dispatch('close-modal', name: 'addProject');
            $this->dispatch('flash', message: 'projects.added', type: 'success');
        } else {
            $this->dispatch('flash', message: 'no-projects-selected', type: 'warning');
        }
    }


    public function render()
    {
        return view('livewire.projects-list');
    }
}
