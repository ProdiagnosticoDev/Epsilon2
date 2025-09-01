<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $estado = (int) (Auth::user()->estado ?? 0);
            if ($estado !== 1) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Send them to login so withErrors() is visible
                /*return redirect()->route('login')->withErrors([
                    'email' => 'Tu cuenta está deshabilitada.',
                ]);*/

                /*return redirect('/')
                ->withErrors([
                    'email' => 'Tu cuenta está deshabilitada.',
                ]);*/

                return redirect()->to(url('/'))
                    ->withErrors([
                        'email' => 'Tu cuenta está deshabilitada. Contacta al administrador del sistema',
                    ]);

            }
        }
        

        return $next($request);
    }
}
