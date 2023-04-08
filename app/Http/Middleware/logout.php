<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\Store;

class logout
{
    protected $session;
    protected $timeout = 1200;

    public function __construct(Store $store)
    {
        $this->session = $store;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $is_logged_in = $request->path() != "/logout";
        if (!session('last_active')) {
            $this->session->put('last_active', time());
        } elseif (time() - $this->session->get('last_active') > $this->timeout) {
            $this->session->forget('last_active');
            $cookie = cookie('intend', $is_logged_in ? url()->current() : 'home');
            auth()->logout();
        }
        $is_logged_in ?
            $this->session->put('last_active', time()) :
            $this->session->forget('last_active');
        return $next($request);
    }
}
