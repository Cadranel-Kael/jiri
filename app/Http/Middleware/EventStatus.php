<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class EventStatus
{
    public function handle(Request $request, Closure $next)
    {
        if(Event::class->where('id', $request->event)->status === 'started') {
            session(['event' => $request->event]);
            return $next($request);
        }
        abort(403, 'Event has not stated yet');
    }
}
