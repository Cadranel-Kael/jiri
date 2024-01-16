<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Livewire\Attributes\Computed;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $events = auth()->user()->events()->whereNull('status')->get();

        $current_event = auth()->user()->events()->where('status', 'started')->first();

        return view('dashboard', compact('events', 'current_event'));
    }
}
