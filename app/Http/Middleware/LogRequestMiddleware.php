<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Request Info', [
            'method' => $request->method(),
            'url' => $request->url(),
            'body' => $request->all()
        ]);

        return $next($request);
    }
}
