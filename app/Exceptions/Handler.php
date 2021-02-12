<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use ArgumentCountError;
use ErrorException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TypeError) {
            $message = $exception->getMessage();

            return $this->errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $mesage = Response::$statusTexts[$code];

            return $this->errorResponse($mesage, $code);
        }

        if ($exception instanceof QueryException) {
            $message = $exception->getMessage();
            return $this->errorResponse($message, Response::HTTP_CONFLICT);
        }

        if ($exception instanceof ErrorException) {
            $message = $exception->getMessage();
            return $this->errorResponse($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof ModelNotFoundException) {

            $model = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instacia de $model con el id especificado", Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {

            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof AuthenticationException) {

            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ValidationException) {

            $errors = $exception->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof RuntimeException) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof ArgumentCountError) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }

        return $this->errorResponse("Error inesperado. Intente más tarde", Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
