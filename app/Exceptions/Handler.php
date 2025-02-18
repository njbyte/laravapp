<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

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

        $this->renderable(function (Throwable $e, Request $request) {
            // Optionally, log the error message
            \Log::error($e);

            // Handle 404 Not Found Exception
            if ($e instanceof NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }

            // Handle other HTTP exceptions
            if ($e instanceof HttpException) {
                return response()->view('errors.error', [], $e->getStatusCode());
            }

            // Default error handler
            return response()->view('errors.error', [], 500);
        });
    }
}
