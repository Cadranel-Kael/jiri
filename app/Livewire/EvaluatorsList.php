<?php

namespace App\Livewire;

use App\Livewire\Forms\EventForm;
use App\Traits\Searchable;
use Livewire\Attributes\Computed;
use Livewire\Component;

class EvaluatorsList extends Component
{
    use Searchable;

    public $event;

    public EventForm $form;

    public $addedEvaluatorsIds = [];

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

    public function addEvaluator($contactId)
    {
        $this->addedEvaluatorsIds[] = $contactId;

    }

    public function removeEvaluator($contactId)
    {
        $this->addedEvaluatorsIds = array_diff($this->addedEvaluatorsIds, [$contactId]);
    }

    public function add()
    {
        if ($this->addedEvaluatorsIds) {
            foreach ($this->addedEvaluatorsIds as $evaluatorsId) {
                $this->form->addEvaluator($evaluatorsId);
            }

            $this->dispatch('close-modal', name: 'addEvaluators');
            $this->dispatch('flash', message: 'evaluators.added', type: 'success');
        } else {
            $this->dispatch('flash', message: 'no-evaluator-selected', type: 'warning');
        }
    }


    public function render()
    {
        return view('livewire.evaluators-list');
    }
}
