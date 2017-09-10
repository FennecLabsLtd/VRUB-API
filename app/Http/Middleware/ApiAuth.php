<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $request->get('key', $request->header('X-Api-Key', false));

        if (!$key) {
            abort(422, 'No public key provided');
        }

        $service = Service::where('public', $key)->first();

        if (!$service) {
            abort(401, "Invalid public key");
        }

        Service::$authenticatedService = $service;

        return $next($request);
    }
}
