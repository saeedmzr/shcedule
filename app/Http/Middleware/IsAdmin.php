<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin {

    public function handle($request, Closure $next) {

        if (auth()->check()) {

            if (auth()->user()->hasRole('Admin')) {

                return $next($request);
            } else {
                return redirect('/admin/login');
            }
        } else {
            return redirect('/admin/login');

        }

    }

}
