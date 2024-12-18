<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTemplate
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login
        if (auth()->check()) {
            // Atur template berdasarkan role
            $role = auth()->user()->role;

            if ($role === 'admin') {
                config(['app.template' => 'tabler']);
            } else {
                config(['app.template' => 'basic']);
            }
        }

        return $next($request);
    }
}
