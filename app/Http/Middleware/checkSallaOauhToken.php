<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OauthToken;
use Illuminate\Support\Facades\Auth;

class checkSallaOauhToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && empty(OauthToken::first())) {
            return redirect()->route('oauth.redirect');
        }
        
        return $next($request);
    }
}
