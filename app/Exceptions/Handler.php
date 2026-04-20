<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
     * @param  \Throwable  $e
     * @return void
     */
    public function report(Throwable $e)
    {
        \Log::error('Global Exception - File: ' . $e->getFile() . ' Line: ' . $e->getLine() . ' Message: ' . $e->getMessage());

        // Always send every exception to Sentry explicitly so that exceptions
        // suppressed by Laravel's internal $internalDontReport list
        // (e.g. ValidationException, AuthenticationException, 404s) are still
        // captured when desired, and so that EMERGENCY-logged exceptions that
        // are caught inside controllers also reach Sentry.
        if (app()->environment('production') && $this->shouldReport($e)
            && !$e instanceof NotFoundHttpException
            && !$e instanceof MethodNotAllowedHttpException
        ) {
       // if (app()->environment('production')) {
            app('sentry')->captureException($e);
        }

        parent::report($e);
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
