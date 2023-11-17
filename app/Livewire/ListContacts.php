<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ListContacts extends Component
{

    public $search = '';

    public string $sort = 'name';
    public string $order = 'ASC';
    public array $sortables = ['name', 'email', 'created_at'];
    private array $addedEvaluatorsIds = [];

    #[Computed]
    public function contacts()
    {
        return auth()
            ->user()
            ->contacts()
            ->whereNotIn('id', $this->addedEvaluatorsIds)
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->order)
            ->paginate(12);
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

    public function addEvaluator($id): void
    {
        if (!in_array($id, $this->addedEvaluatorsIds)) {
            $this->addedEvaluatorIds[] = $id;
        }
    }

    #[Computed]
    public function addedEvaluators()
    {
        return auth()->user()->contacts()->whereIn('id', $this->addedEvaluatorsIds)->get();
    }


    public function render()
    {
        return view('livewire.list-contacts');
    }
}
