<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPosition
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (!is_null($request->lat) && !is_null($request->lon)) {
                User::query()
                    ->find(Auth::id())
                    ->update(
                        [
                            'latitude' => $request->lat,
                            'longitude' => $request->lon,
                        ]
                    );
            }
        }
        return $next($request);
    }
}
