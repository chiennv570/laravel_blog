<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->age <= 200) {
            var_dump($request->path());
            die;
//            $currentPath= Route::getFacadeRoot()->current()->uri();
//            var_dump($currentPath); die;
//            return redirect('welcome');
        }

        return $next($request);
    }
}
