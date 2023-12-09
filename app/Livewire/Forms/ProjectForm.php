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

    #[Validate('required|min:3')]
    public $title;

    #[Validate('required|min:5')]
    public $description;


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
        if (!Gate::allows('handle-project', $this->project)) {
            abort(403);
        }

        $this->validate();

        $this->project->update($this->all());

        session()->flash('success', __('projects.updated'));
    }

    public function destroy()
    {
        if (!Gate::allows('handle-project', $this->project)) {
            abort(403);
        }

        $this->project->delete();

        session()->flash('success', __('projects.deleted'));
    }
}
