<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    public ?Project $project;

    #[Validate('required|min:1')]
    public $title;

    #[Validate('required|min:5')]
    public $description;

    public $link;

    public $tasks = [];

    public function setProject(Project $project)
    {
        $this->project = $project;

        $this->title = $project->title;

        $this->description = $project->description;

        $this->link = $project->link;

        $this->tasks = $project->tasks;
    }

    public function addTask()
    {
        $this->tasks[] = '';
    }


    public function store()
    {
        $this->validate();

        $this->project = Auth::user()
            ->contacts()
            ->save(new Project($this->all()));

        session()->flash('success', __('projects.created'));

        return $this->project;
    }

    public function update()
    {
        $this->tasks = array_filter($this->tasks);

        $this->validate();

        $this->project->update($this->all());

        session()->flash('success', __('projects.updated'));
    }

    public function destroy()
    {
        $this->project->delete();

        session()->flash('success', __('projects.deleted'));
    }
}
