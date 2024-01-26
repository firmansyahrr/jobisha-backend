<?php

namespace App\Http\Middleware;

use App\Services\RequestService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty($request->session()->get('app_token', '')) && !$request->session()->get('authenticated', false)) {
            $request->session()->invalidate();
            $request->session()->forget('app_token');
            $request->session()->forget('user');
            $request->session()->forget('authenticated');
            $request->session()->flush();

            return redirect()->route('auth.login')->with('error', 'You must login first');
        }

        return $next($request);
    }
}
