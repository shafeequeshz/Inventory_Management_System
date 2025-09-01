<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogApiResponseSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $content = $response->getContent();
        $size = strlen($content);

        Log::info('API Response Size', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => $response->getStatusCode(),
            'size_bytes' => $size,
        ]);

        return $response;
    }
}
