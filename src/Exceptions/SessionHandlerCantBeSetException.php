<?php declare(strict_type=1);

namespace Ellipse\Session\Exceptions;

use RuntimeException;

class SessionHandlerCantBeSetException extends RuntimeException
{
    public function __construct()
    {
        $msg = "The session handler can't be set.";

        parent::__construct($msg);
    }
}
