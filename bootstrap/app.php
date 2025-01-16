<?php

use App\Formatters\Formatter;
use App\Formatters\Response\StatusMessage;
use App\Http\Middleware\IpValidator;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'ipCheck' => IpValidator::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception) {
            $formatter = new Formatter();
            $defaultErrorStatus = [
                'status' => StatusMessage::getStatusCode($exception->getCode()),
                'message' => '[Exception]' . $exception->getMessage()
            ];
            return $formatter->formatResponse($defaultErrorStatus);
        });
    })->create();
