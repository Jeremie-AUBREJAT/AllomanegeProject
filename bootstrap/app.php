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
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    $app->withExceptions(function ($exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });
    });