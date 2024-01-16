<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use App\Traits\Searchable;
use Livewire\Attributes\Computed;
use Livewire\Component;

class StudentList extends Component
{
    use Searchable;

    public $event;

    public EventForm $form;

    public $addedStudentsIds = [];

    public $addedProjects = [];

    public function mount(): void
    {
        $this->setSortables(['name', 'email', 'created_at']);
        $this->form->setEvent($this->event);
    }

    #[Computed]
    public function contacts()
    {
        return auth()
            ->user()
            ->contacts()
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->whereNotIn('id', $this->event->contacts->pluck('id')->toArray())
            ->orderBy($this->sort, $this->order)
            ->paginate(12);
    }

    public function addStudent($contactId)
    {
        $this->addedStudentsIds[] = $contactId;

    }

    public function removeStudent($contactId)
    {
        $this->addedEvaluatorsIds = array_diff($this->addedEvaluatorsIds, [$contactId]);
    }

    public function add()
    {
        if ($this->addedStudentsIds) {
            foreach ($this->addedStudentsIds as $studentId) {
                $this->form->addStudent($studentId);
            }

            $this->dispatch('close-modal', name: 'addStudents');
            $this->dispatch('flash', message: 'student.added', type: 'success');
        } else {
            $this->dispatch('flash', message: 'no-student-selected', type: 'warning');
        }
    }

    public function render()
    {
        return view('livewire.student-list');
    }
}
