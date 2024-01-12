<?php

namespace App\Http\Middleware;

use App\Models\Participant;
use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        if (Participant::class->where('token', $request->token)->where('event_id', $request->event)->exists()) {
            return route('evaluation.index');
        }

        return $next($request);
    }
}
