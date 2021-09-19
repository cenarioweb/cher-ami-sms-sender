<?php

namespace CenarioWeb\CherAmi\Exceptions;

use Exception as BaseException;

class InvalidProviderException extends BaseException
{
    protected $code = 404;

    public function __construct($message = null)
    {
        if (!$message) {
            $message = 'Provedor não encontrado.';
        }

        parent::__construct($message, $this->getCode());
    }
}
