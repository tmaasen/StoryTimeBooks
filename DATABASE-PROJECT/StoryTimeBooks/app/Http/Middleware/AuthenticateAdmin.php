<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role === '2') {
            return $next($request);
        }
        else {
            abort(403);
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}