<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleContact extends Component
{
    public int $id = 1;

    #[Computed]
    public function contact()
    {
        return auth()->user()->load('contacts')->contacts()->where('id', '=', $this->id)->first();
    }

    public function render()
    {
        return view('livewire.single-contact');
    }
}
