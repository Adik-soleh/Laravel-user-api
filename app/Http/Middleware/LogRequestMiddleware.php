<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Incoming Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
            'body' => $request->except(['password']), 
        ]);

        $response = $next($request);

        Log::info('Response Sent', [
            'status' => $response->status(),
            'body' => $response->getContent(),
        ]);

        return $response;
    }
}
