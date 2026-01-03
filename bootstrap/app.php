<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.guest'=>\App\Http\Middleware\AdminRedirect::class,
            'admin.auth'=>\App\Http\Middleware\AdminAuthenticate::class,
            'head.guest'=>\App\Http\Middleware\HeadRedirect::class,
            'head.auth'=>\App\Http\Middleware\HeadAuthenticate::class,
            'staff.guest'=>\App\Http\Middleware\StaffRedirect::class,
            'staff.auth'=>\App\Http\Middleware\StaffAuthenticate::class,
        ]);
        // $middleware->alias([
        //     'head.guest'=>\App\Http\Middleware\HeadRedirect::class,
        //     'head.auth'=>\App\Http\Middleware\HeadAuthenticate::class,
        // ]);
        $middleware->redirectTo(
            guests:'/staff/login',
            users:'/staff/dashboard'
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
