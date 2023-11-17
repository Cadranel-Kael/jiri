<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ListProjects extends Component
{
    public $search = '';
    public $addedProjectsIds = [];

    public string $sort = 'title';
    public string $order = 'ASC';
    public array $sortables = ['title', 'created_at'];


    #[Computed]
    public function projects()
    {
        return auth()
            ->user()
            ->projects()
            ->whereNotIn('id', $this->addedProjectsIds)
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->get();
    }

    public function changeOrder()
    {
        if ($this->order === 'ASC')
        {
            $this->order = 'DESC';
        } else {
            $this->order = 'ASC';
        }
    }

    public function addProject($id): void
    {
        if (!in_array($id, $this->addedProjectsIds)) {
            $this->addedProjectsIds[] = $id;
        }
    }

    public function removeProject($id): void
    {
        if (in_array($id, $this->addedProjectsIds)) {
            $this->addedProjectsIds = array_diff($this->addedProjectsIds, [$id]);
        }
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()->user()->projects()->whereIn('id', $this->addedProjectsIds)->get();
    }

    public function render()
    {
        return view('livewire.list-projects');
    }
}
