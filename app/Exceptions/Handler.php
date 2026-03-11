<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        \Log::error('Global Exception - File: ' . $exception->getFile() . ' Line: ' . $exception->getLine() . ' Message: ' . $exception->getMessage());

        // Log additional details for validation exceptions
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            \Log::error('Validation Exception Details: ', [
                'errors' => $exception->errors(),
                'input' => request()->except(['password', 'password_confirmation']),
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'user_agent' => request()->userAgent(),
                'ip' => request()->ip()
            ]);
        }

        // Always send every exception to Sentry explicitly so that exceptions
        // suppressed by Laravel's internal $internalDontReport list
        // (e.g. ValidationException, AuthenticationException, 404s) are still
        // captured when desired, and so that EMERGENCY-logged exceptions that
        // are caught inside controllers also reach Sentry.
        if (app()->environment('production') &&
            !($exception instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) &&
            !($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
        ) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
