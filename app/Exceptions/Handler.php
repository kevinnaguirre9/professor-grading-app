<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use ProfessorGradingApp\Domain\Common\Exceptions\CoreException;
use ProfessorGradingApp\Domain\User\Exceptions\UserWithGivenEmailAlreadyRegistered;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class Handler
 *
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];
    /**
     * @var array
     */
    private array $badRequestExceptions = [
        UserWithGivenEmailAlreadyRegistered::class,
    ];

    /**
     * @var array
     */
    private array $notFoundExceptions = [];

    /**
     * @var array
     */
    protected array $unauthorizedExceptions = [];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @param  Request  $request
     * @param  \Throwable  $exception
     * @return Response|JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (env('APP_DEBUG'))
            return parent::render($request, $exception);

        $status = $this->getStatusCodeFor($exception);

        $data = [];

        if($exception instanceof CoreException) {

            $data = [
                'type' => $exception->type(),
                'title' => $exception->title(),
                'status' => $status,
                'detail' => $exception->detail(),
                'instance' => $request->getRequestUri(),
            ];
        }

        //TODO: handle other exception types (KISS)

//        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
//
//        if ($exception instanceof MethodNotAllowedHttpException)
//        {
//            $status = Response::HTTP_METHOD_NOT_ALLOWED;
//            $exception = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $exception);
//        }
//        else if ($this->isNotFoundException($exception))
//        {
//            $status = Response::HTTP_NOT_FOUND;
//            $exception = new NotFoundHttpException($exception->getMessage() ?? 'HTTP_NOT_FOUND', $exception);
//        }
//        else if ($this->isBadRequestException($exception))
//        {
//            $status = Response::HTTP_BAD_REQUEST;
//            $exception = new HttpException($status, $exception->getMessage() ?? 'HTTP_BAD_REQUEST', $exception);
//        }
//        else if ($exception instanceof ValidationException)
//        {
//            $status = Response::HTTP_BAD_REQUEST;
//            $exception = new HttpException($status, $exception->getResponse()->getContent());
//        }
//        else if ($exception)
//        {
//            $exception = new HttpException($status, $exception->getMessage());
//        }
//
//        $message = $exception->getMessage();
//
//        return response()->json([
//            'error' => [
//                'message' => json_decode($message) ?? $message,
//                'status' => $status,
//            ],
//        ], $status);

        return response()->json(
            data: $data,
            status: $status,
            options: JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @param Throwable $exception
     * @return int
     */
    private function getStatusCodeFor(Throwable $exception): int
    {
        if ($this->isUnauthorizedException($exception))
            return Response::HTTP_UNAUTHORIZED;

        if ($this->isNotFoundException($exception))
            return Response::HTTP_NOT_FOUND;

        if ($this->isBadRequestException($exception))
            return Response::HTTP_BAD_REQUEST;

        if($exception instanceof CoreException)
            return Response::HTTP_BAD_REQUEST;

        if ($exception instanceof ValidationException)
            return Response::HTTP_UNPROCESSABLE_ENTITY;

        if ($exception instanceof MethodNotAllowedHttpException)
            return Response::HTTP_METHOD_NOT_ALLOWED;

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isNotFoundException(Throwable $exception) : bool
    {
        return collect($this->notFoundExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isBadRequestException(Throwable $exception): bool
    {
        return collect($this->badRequestExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isUnauthorizedException(Throwable $exception): bool
    {
        return collect($this->unauthorizedExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return \Closure
     */
    private function validateInstanceOf(Throwable $exception): \Closure
    {
        return function ($exceptionClass) use ($exception) {
            return $exception instanceof $exceptionClass;
        };
    }
}
