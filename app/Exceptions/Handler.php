<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): \Illuminate\Http\Response|JsonResponse|array|Response|RedirectResponse
    {
        if ($e instanceof ModelNotFoundException) {
            // get the model name
            $modelName = strtolower(class_basename($e->getModel()));
            $result = failedResponse(Response::HTTP_NOT_FOUND, ['error' => "Does not exists any {$modelName} with the specified identification"]);
            return response()->json($result, Response::HTTP_NOT_FOUND);

        } elseif ($e instanceof NotFoundHttpException) {
            $result = failedResponse(Response::HTTP_NOT_FOUND, ['error' => 'NoT found']);
            return response()->json($result, Response::HTTP_NOT_FOUND);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $result = failedResponse(Response::HTTP_METHOD_NOT_ALLOWED, ['error' => 'Method not allowed']);
            return response()->json($result, Response::HTTP_METHOD_NOT_ALLOWED);
        } elseif ($e instanceof AuthenticationException) {
            $result = failedResponse(Response::HTTP_UNAUTHORIZED, ['error' => 'Unauthenticated']);
            return response()->json($result, Response::HTTP_UNAUTHORIZED);
        }  elseif ($e instanceof \ErrorException) {
            $result = failedResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['error' => 'Internal server error']);
            return response()->json($result, Response::HTTP_INTERNAL_SERVER_ERROR);
        } elseif ($e instanceof \Exception) {
            $result = failedResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['error' => 'Internal server error']);
            return response()->json($result, Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        return parent::render($request, $e);
    }
}
