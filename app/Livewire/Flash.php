<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Flash extends Component
{
    public $flashes = [];

    #[On('flash')]
    public function flash($message, $type)
    {
        $this->flashes[] = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public function render()
    {
        return view('livewire.flash');
    }
}
