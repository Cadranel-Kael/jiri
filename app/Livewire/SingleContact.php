<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SingleContact extends Component
{
    public int $id = 1;

    #[Computed]
    public function contact()
    {
        return auth()->user()->contacts()->where('id', $this->id)->first();
    }

    #[Computed]
    public function events()
    {
        return $this->contact->participations->map->event;
    }

    public function render()
    {
        return view('livewire.single-contact');
    }
}
