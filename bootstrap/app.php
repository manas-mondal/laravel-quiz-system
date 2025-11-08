<?php

use App\Http\Middleware\CheckAdminAuth;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckUserAuth;
use App\Http\Middleware\RedirectIfAuthenticatedUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('user-auth',CheckUserAuth::class);
        $middleware->appendToGroup('admin-auth',CheckAdminAuth::class);
        $middleware->alias([
            'guest-user'=>RedirectIfAuthenticatedUser::class,
            'checkAdmin'=>CheckAdminRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
