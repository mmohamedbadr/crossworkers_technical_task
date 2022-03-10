<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
    }
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'ok' => false,
                'message' => __('Fail'),
                'errors' => [],
                'statusCode' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {
            return response()->json([
                'ok' => false,
                'message' => __('Fail'),
                'errors' => [],
                'statusCode' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json(
                [
                    'ok' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [],
                    'statusCode' => Response::HTTP_METHOD_NOT_ALLOWED,
                ],
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        }
        if ($exception instanceof AccessDeniedHttpException && $request->wantsJson()) {
            return response()->json(
                [
                    'ok' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [],
                    'statusCode' => Response::HTTP_UNAUTHORIZED,
                ],
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        }

        return parent::render($request, $exception);
    }
}
