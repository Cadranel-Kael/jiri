<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use App\Livewire\Forms\EventForm;
use App\Livewire\Forms\ProjectForm;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEvent extends Component
{
    public $projectSearch = '';
    public string $projectSort = 'title';
    public string $projectOrder = 'ASC';
    public array $projectSortables = ['title', 'created_at'];
    public array $addedProjectsIds = [];

    public $evaluatorSearch = '';
    public string $evaluatorSort = 'name';
    public string $evaluatorOrder = 'ASC';
    public array $evaluatorSortables = ['name', 'email', 'created_at'];
    public array $addedEvaluatorsIds = [];

    public $studentSearch = '';
    public string $studentOrder = 'ASC';
    public string $studentSort = 'name';
    public array $studentSortables = ['name', 'email', 'created_at'];
    public array $addedStudentsIds = [];


    public EventForm $eventForm;
    public ProjectForm $createProjectForm;
    public ContactForm $createEvaluatorForm;
    public ContactForm $createStudentForm;

    // format: [student_id => [project_id => [task_id => [task_id, task_id]]]]
    public array $tasks = [];

    public function changeOrder(string $collection)
    {
        switch ($collection) {
            case 'projects':
                $this->projectOrder = $this->projectOrder === 'ASC' ? 'DESC' : 'ASC';
                break;
            case 'evaluators':
                $this->evaluatorOrder = $this->evaluatorOrder === 'ASC' ? 'DESC' : 'ASC';
                break;
            case 'students':
                $this->studentOrder = $this->studentOrder === 'ASC' ? 'DESC' : 'ASC';
                break;
        }

    }

    // add a collection to its added collection
    public function add(string $collection, int $id): void
    {
        switch ($collection) {
            case 'projects':
                if (!in_array($id, $this->addedProjectsIds) && auth()->user()->projects()->where('id', $id)->exists()) {
                    $this->addedProjectsIds[] = $id;
                }
                break;
            case 'evaluators':
                if (!in_array($id, $this->addedEvaluatorsIds) && !in_array($id, $this->addedStudentsIds) && auth()->user()->contacts()->where('id', $id)->exists()) {
                    $this->addedEvaluatorsIds[] = $id;
                }
                break;
            case 'students':
                if (!in_array($id, $this->addedEvaluatorsIds) && !in_array($id, $this->addedStudentsIds) && auth()->user()->contacts()->where('id', $id)->exists()) {
                    $this->addedStudentsIds[] = $id;
                }
                break;
        }
    }

    // removes a collection from its added collection
    public function remove(string $collection, int $id): void
    {
        switch ($collection) {
            case 'projects':
                if (in_array($id, $this->addedProjectsIds)) {
                    $this->addedProjectsIds = array_diff($this->addedProjectsIds, [$id]);
                }
                break;
            case 'evaluators':
                if (in_array($id, $this->addedEvaluatorsIds)) {
                    $this->addedEvaluatorsIds = array_diff($this->addedEvaluatorsIds, [$id]);
                }
                break;
            case 'students':
                if (!in_array($id, $this->addedEvaluatorsIds)) {
                    $this->addedStudentsIds = array_diff($this->addedStudentsIds, [$id]);
                }
                break;
        }
    }

    #[Computed]
    public function projects()
    {
        return auth()
            ->user()
            ->projects()
            ->whereNotIn('id', $this->addedProjectsIds)
            ->where('title', 'like', '%' . $this->projectSearch . '%')
            ->orderBy($this->projectSort, $this->projectOrder)
            ->paginate(10);
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()
            ->user()
            ->projects()
            ->whereIn('id', $this->addedProjectsIds)
            ->where('title', 'like', '%' . $this->projectSearch . '%')
            ->get();
    }

    #[Computed]
    public function evaluators()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereNotIn('id', $this->addedEvaluatorsIds)
            ->whereNotIn('id', $this->addedStudentsIds)
            ->where('name', 'like', '%' . $this->evaluatorSearch . '%')
            ->orderBy($this->evaluatorSort, $this->evaluatorOrder)
            ->paginate(10);
    }

    #[Computed]
    public function addedEvaluators()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereIn('id', $this->addedEvaluatorsIds)
            ->where('name', 'like', '%' . $this->evaluatorSearch . '%')
            ->get();
    }

    #[Computed]
    public function students()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereNotIn('id', $this->addedEvaluatorsIds)
            ->whereNotIn('id', $this->addedStudentsIds)
            ->where('name', 'like', '%' . $this->studentSearch . '%')
            ->orderBy($this->studentSort, $this->studentOrder)
            ->paginate(10);
    }

    #[Computed]
    public function addedStudents()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereIn('id', $this->addedStudentsIds)
            ->where('name', 'like', '%' . $this->studentSearch . '%')
            ->get();
    }

    public function toggleTasks($student_id, $project_id, array $tasks)
    {
        if (!isset($this->tasks[$student_id][$project_id])) {
            $this->tasks[$student_id][$project_id] = [];
        }
        foreach ($tasks as $task) {
            if (!in_array($task, $this->tasks[$student_id][$project_id])) {

                $this->tasks[$student_id][$project_id][] = $task;

            } elseif (in_array($task, $this->tasks[$student_id][$project_id])) {
                $this->tasks[$student_id][$project_id] = array_diff($this->tasks[$student_id][$project_id], [$task]);
            }
        }
    }

    public function matchTask($student_id, $project_id, $task)
    {
        if (isset($this->tasks[$student_id][$project_id]) && in_array($task, $this->tasks[$student_id][$project_id])) {
            return true;
        }
        return false;
    }

    public function save()
    {
        $this->eventForm->store();

        foreach ($this->addedProjectsIds as $addedProjectsId) {
            $this->eventForm->addProject($addedProjectsId, 1);
        }

        foreach ($this->addedStudentsIds as $addedStudentsId) {
            $this->eventForm->addStudent($addedStudentsId);
        }

        foreach ($this->addedEvaluatorsIds as $addedEvaluatorsId) {
            $this->eventForm->addEvaluator($addedEvaluatorsId);
        }

        $this->redirect(route('events.index'));
    }

    public function saveProject()
    {
        $project = $this->createProjectForm->store();
        if ($project != null) {
            $this->addedProjectsIds[] = $project->id;
            $this->dispatch('form-submitted');
        }
    }

    public function saveEvaluator()
    {
        $evaluator = $this->createEvaluatorForm->store();
        if ($evaluator != null) {
            $this->addedEvaluatorsIds[] = $evaluator->id;
            $this->dispatch('form-submitted');
        }
    }


    public function saveStudent()
    {
        $student = $this->createStudentForm->store();
        if ($student != null) {
            $this->addedStudentsIds[] = $student->id;
            $this->dispatch('form-submitted');
        }
    }

    public function render()
    {
        return view('livewire.create-event');
    }
}
