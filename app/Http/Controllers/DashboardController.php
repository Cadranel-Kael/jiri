<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $events = auth()->user()->load('events')->events->where('date', '>', Carbon::today());


        return view('dashboard', compact('events'));
    }
}
