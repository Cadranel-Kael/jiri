<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $events = auth()->user()->load('events')->events->whereNull('status');


        return view('dashboard', compact('events'));
    }
}
