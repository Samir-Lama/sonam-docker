<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (in_array('customer', $this->guards)) {
                return route('login');
            }

            return route('admin.login');
        }
    }
}
