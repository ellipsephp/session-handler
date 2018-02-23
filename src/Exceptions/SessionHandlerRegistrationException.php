<?php declare(strict_types=1);

namespace Ellipse\Session\Exceptions;

use RuntimeException;

class SessionHandlerRegistrationException extends RuntimeException implements SessionHandlerExceptionInterface
{
    public function __construct()
    {
        $msg = "The session handler can't be set.";

        parent::__construct($msg);
    }
}
