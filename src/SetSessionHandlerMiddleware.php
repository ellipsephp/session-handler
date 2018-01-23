<?php declare(strict_types=1);

namespace Ellipse\Session;

use SessionHandlerInterface;
use RuntimeException;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Session\Exceptions\SessionHandlerCantBeSetException;

class SetSessionHandlerMiddleware implements MiddlewareInterface
{
    /**
     * The session handler to use.
     *
     * @var \SessionHandlerInterface
     */
    private $handler;

    /**
     * Set up a session handler middleware with the given session handler.
     *
     * @param \SessionHandlerInterface $handler
     */
    public function __construct(SessionHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Set the session handler and delegate the request processing.
     *
     * @param \Psr\Http\Message\ServerRequestInterface  $request
     * @param \Psr\Http\Server\RequestHandlerInterface  $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws RuntimeException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if(session_set_save_handler($this->handler)) {

            return $handler->handle($request);

        }

        throw new SessionHandlerCantBeSetException;
    }
}
