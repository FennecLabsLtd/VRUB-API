<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;

class SecretApiAuth
{
    // Currently not used, but in the future there may be stuff you don't want your public API key doing.

    public function handle($request, Closure $next)
    {
        $key = $request->get('key', $request->header('X-Secret-Key', false));

        if (!$key) {
            abort(422, "No secret key provided");
        }

        $service = Service::where('secret', $key)->first();

        if (!$service) {
            abort(401, "Invalid secret key");
        }

        Service::$authenticatedService = $service;

        return $next($request);
    }
}
