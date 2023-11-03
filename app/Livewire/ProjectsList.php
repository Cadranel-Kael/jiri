<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsList extends Component
{
    public $search = '';
    public $sort = 'title';
    public $per_page = 18;

    #[Computed]
    public function projects()
    {
        return auth()->user()->load('projects')->projects()->where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, 'desc')
            ->paginate($this->per_page);
    }
}
