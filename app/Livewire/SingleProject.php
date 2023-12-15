<?php

namespace App\Livewire;

use App\Livewire\Forms\ProjectForm;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleProject extends Component
{
    public $id;
    public $editMode = false;

    public ProjectForm $form;

    public function mount()
    {
        $this->form->setProject(auth()->user()->projects()->where('id', $this->id)->first());
    }

    #[Computed]
    public function project()
    {
        return auth()->user()->projects()->where('id', $this->id)->first();
    }

    public function toggleEditMode()
    {
        logger('test');
        $this->editMode = !$this->editMode;
    }

    public function addTask()
    {
        $this->form->addTask();
    }

    public function removeTask($index)
    {
        unset($this->form->tasks[$index]);
    }

    public function update()
    {
        $this->form->update();

        $this->redirect(route('projects.show', $this->id));
    }

    public function cancel()
    {
        $this->form->setProject($this->project());
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.single-project');
    }
}
