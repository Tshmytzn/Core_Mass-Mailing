<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AccountAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $this->checkAuth();
        if ($response instanceof \Illuminate\Http\RedirectResponse) {
            return $response;
        }

        return $next($request);
    }

    protected function checkAuth()
    {
        if (!Session::has('acc_id')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
    }
}
