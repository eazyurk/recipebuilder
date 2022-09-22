<?php

namespace App\Exceptions;

use Exception;

class CouldNotAuthenticateException extends Exception
{
    public function report(): string
    {
        return $this->getMessage();
    }
}
