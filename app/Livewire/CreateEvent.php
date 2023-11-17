<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class CreateEvent extends Component
{
    public $projectSearch = '';
    public string $projectSort = 'title';
    public string $projectOrder = 'ASC';
    public array $projectSortables = ['title', 'created_at'];
    public $addedProjectsIds = [];

    public $evaluatorSearch = '';
    public string $evaluatorSort = 'name';
    public string $evaluatorOrder = 'ASC';
    public array $evaluatorSortables = ['name', 'email', 'created_at'];
    public $addedEvaluatorsIds = [];

    public $studentSearch = '';
    public string $studentOrder = 'ASC';
    public string $studentSort = 'name';
    public array $studentSortables = ['name', 'email','created_at'];
    public $addedStudentsIds = [];

    public function changeOrder($order)
    {
        $order = $order === 'ASC' ? 'DESC' : 'ASC';
    }

    public function add($array, $id):void
    {
        if (!in_array($id, $this->$array)) {
            $array[] = $id;
        }
    }

    public function remove($array, $id): void
    {
        if (in_array($id, $array)) {
            $array =  array_diff($array, [$id]);
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
            ->get();
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()
            ->user()
            ->projects()
            ->whereIn('id', $this->addedProjectsIds)
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
            ->get();
    }

    #[Computed]
    public function addedEvaluators()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereIn('id', $this->addedEvaluatorsIds)
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
            ->get();
    }

    #[Computed]
    public function addedStudents()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereIn('id', $this->addedStudentsIds)
            ->get();
    }

    public function render()
    {
        return view('livewire.create-event');
    }
}
