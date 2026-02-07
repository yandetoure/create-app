<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'auth', 'role:admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth', 'role:developer'])
                ->prefix('developer')
                ->name('developer.')
                ->group(base_path('routes/developer.php'));

            Route::middleware(['web', 'auth', 'role:client'])
                ->prefix('client')
                ->name('client.')
                ->group(base_path('routes/client.php'));

            Route::middleware(['web', 'auth', 'role:community_manager'])
                ->prefix('cm')
                ->name('cm.')
                ->group(base_path('routes/cm.php'));

            Route::middleware(['web', 'auth', 'role:project_lead'])
                ->prefix('lead')
                ->name('lead.')
                ->group(base_path('routes/lead.php'));

            // Notifications routes (accessible to all authenticated users)
            Route::middleware(['web'])->group(base_path('routes/notifications.php'));

            // Comments routes (accessible to all authenticated users)
            Route::middleware(['web'])->group(base_path('routes/comments.php'));

            // Time tracking routes (accessible to all authenticated users)
            Route::middleware(['web'])->group(base_path('routes/time-tracking.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
