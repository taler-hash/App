<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class studentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd(!$request->session()->missing('name') and session('data') === 'student');
        if($request->session()->missing('name') && !session('data') === 'student')
        {
            return redirect('/login');
        }
        
        return $next($request);
    }
}