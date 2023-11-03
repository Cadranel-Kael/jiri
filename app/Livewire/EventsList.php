<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class EventsList extends Component
{
    public $search = '';
    public $sort = 'date';
    public $per_page = 18;

    #[Computed]
    public function events()
    {
        return auth()->user()->load('events')->events()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, 'desc')
            ->paginate($this->per_page);
    }

    public function render()
    {
        return view('livewire.events-list');
    }
}
