<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class EventLivewireController extends Component
{
    public $search = '';
    public $sort = 'date';
    public $perPage = 18;
    public array $sortables = ['name', 'email', 'created_at'];

    #[Computed]
    public function events()
    {
        return auth()->user()->load('events')->events()->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.events');
    }
}
