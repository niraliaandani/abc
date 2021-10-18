<?php

namespace App\Exceptions;

use App\Utils\ResponseUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
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

    /**
     * @param  Request  $request
     * @param  Throwable  $e
     *
     * @return JsonResponse|Response|ResponseAlias
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        \Log::error($e->getTraceAsString());
        if ($e instanceof ModelNotFoundException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'RECORD_NOT_FOUND',
                'Record not found with specified criteria.',
                'Record not found with specified criteria.'
            ), ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($e instanceof ValidationException && $request->expectsJson()) {
            $firstError = collect($e->errors())->first();
            return response()->json(ResponseUtil::generateResponse(
                'VALIDATION_ERROR',
                'Invalid Data, Validation Failed',
                $firstError[0]
            ), ResponseAlias::HTTP_BAD_REQUEST);
        }

        if ($e instanceof UnauthorizedException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateError(
                'UNAUTHORIZED',
                'User does not have the right permissions.',
                'User does not have the right permissions.',
            ), ResponseAlias::HTTP_FORBIDDEN);
        }

        if ($e instanceof BadRequestException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'UNAUTHORIZED',
                'The request cannot be fulfilled due to bad syntax',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof ChangePasswordFailureException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'FAILURE',
                "Password cannot be changed due to ".$e->getMessage(),
                []
            ), $e->getCode());
        }

        if ($e instanceof DuplicateDataException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
            'VALIDATION_ERROR',
            'Data Duplication Found',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof FailedSoftDeleteException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'FAILURE',
                'Data can not be deleted due to internal server error',
                []
            ), $e->getCode());
        }

        if ($e instanceof FailureResponseException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'FAILURE',
                'Internal Server Error',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof InsufficientParametersException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'BAD_REQUEST',
                'Insufficient parameters',
                []
            ), $e->getCode());
        }

        if ($e instanceof InvalidParamsException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'VALIDATION_ERROR',
                'Invalid values in parameters',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof LoginFailedException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'BAD_REQUEST',
                'Login Failed',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof LoginUnAuthorizeException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateError(
                'UNAUTHORIZED',
                'You are not authorized to access the request',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof UnAuthorizedRequestException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateError(
                'UNAUTHORIZED',
                'You are not authorized to access the request',
                $e->getMessage()
            ), $e->getCode());
        }

        if ($e instanceof UsernamePasswordWrongException && $request->expectsJson()) {
            return response()->json(ResponseUtil::generateResponse(
                'BAD_REQUEST',
                'username or password is wrong',
                []
            ), $e->getCode());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'STATUS' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                'MESSAGE' => $e->getMessage(),
                'ERROR' => $e->getMessage()
            ],ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $e);
    }
}
