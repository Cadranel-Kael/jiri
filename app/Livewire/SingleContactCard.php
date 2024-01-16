<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

class SingleContactCard extends Component
{
    public $contact;

    public function placholder()
    {
        return <<<'HTML'
        <div class="bg-white justify-between drop-shadow p-4 flex flex-col items-center box-border rounded">
            <div class="animate-pulse rounded-full w-24 h-24 mb-6 bg-black-50"></div>
            <div class="animate-pulse h-6 mb-4 bg-black-50 w-32 rounded-full"></div>
            <div class="animate-pulse h-6 mb-8 bg-black-50 w-64 rounded-full"></div>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.single-contact-card');
    }
}
