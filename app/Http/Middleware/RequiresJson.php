<?php

namespace App\Http\Middleware;

use Closure;

class RequiresJson
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
        abort_if(!$request->wantsJson(), 404, 'Only JSON requests are accepted.');

        return $next($request);
    }
}
