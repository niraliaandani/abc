<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LoginUnAuthorizeException extends Exception
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
   public function __construct($message = "", $code = Response::HTTP_UNAUTHORIZED, Throwable $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }
}
