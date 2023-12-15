<?php

namespace App\Livewire;

use App\Livewire\Forms\ProjectForm;
use App\Models\EventsProject;
use App\Models\Project;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectsLivewireController extends Component
{

    #[Url(as: 's')]
    public $search = '';

    #[Url]
    public $id = '1';

    public string $sort = 'title';
    public string $order = 'ASC';
    public array $sortables = ['title', 'created_at'];

    public ProjectForm $createProjectForm;
    public ProjectForm $editProjectForm;

    public $perPage = 12;

    #[Computed]
    public function projects()
    {
        return auth()->user()->projects()->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate($this->perPage);
    }

    public function addTask()
    {
        $this->createProjectForm->addTask();
    }

    public function removeTask($key)
    {
        unset($this->createProjectForm->tasks[$key]);
    }

    public function changeOrder()
    {
        if ($this->order === 'ASC') {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
    }

    public function loadMore()
    {
        $this->per_page += 12;
    }

    public function save()
    {
        $this->createProjectForm->store();

        return Redirect::to(route('projects.index'));
    }

    public function delete($id)
    {
        if (EventsProject::where('project_id', $id)->exists()) {
            session()->flash('error', __('error.project_has_events'));
            return Redirect::to(route('projects.index'));
        }

        $this->editProjectForm->setProject(Project::find($id));

        $this->editProjectForm->destroy();

        return Redirect::to(route('projects.index'));
    }

    public function render()
    {
        return view('livewire.projects');
    }
}
