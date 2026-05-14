<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHotspotParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Required parameters from MikroTik redirect
        $requiredParams = ['mac', 'ip', 'link-login-only'];

        foreach ($requiredParams as $param) {
            if (!$request->has($param)) {
                return response()->view('errors.not_hotspot', [], 400);
            }
        }

        return $next($request);
    }
}
