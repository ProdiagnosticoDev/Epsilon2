<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\EnsureUserIsEnabled;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'estado' => EnsureUserIsEnabled::class,
            // Spatie Permission middleware aliases:
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message'  => 'Tu sesión ha expirado. Inicia sesión nuevamente.',
                    'redirect' => route('login'),
                ], 401);
            }
            return redirect()->guest(route('login'))
                   ->with('error', 'Tu sesión ha expirado. Inicia sesión nuevamente.');
        });

        $exceptions->render(function (TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Sesión expirada (CSRF). Recarga la página.',
                ], 419);
            }
            return redirect()->back()
                   ->withInput()
                   ->with('error', 'Sesión expirada (CSRF). Intenta de nuevo.');
        });
    })->create();
