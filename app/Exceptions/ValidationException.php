<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ValidationException extends Exception
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
   public function __construct($message = "", $code = Response::HTTP_UNPROCESSABLE_ENTITY, Throwable $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }
}
