<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Session\SessionHandlerMiddleware;
use Ellipse\Session\Exceptions\SessionHandlerCantBeSetException;

describe('SessionHandlerMiddleware', function () {

    beforeEach(function () {

        $this->newhandler = mock(SessionHandlerInterface::class)->get();

        $this->middleware = new SessionHandlerMiddleware($this->newhandler);

    });

    it('should implement MiddlewareInterface', function () {

        expect($this->middleware)->toBeAnInstanceOf(MiddlewareInterface::class);

    });

    describe('->process()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class)->get();
            $this->response = mock(ResponseInterface::class)->get();

            $this->handler = mock(RequestHandlerInterface::class);

            $this->handler->handle->returns($this->response);

        });

        context('when the session_set_save_handler method returns true', function () {

            it('should proxy the request handler ->handle() method', function () {

                allow('session_set_save_handler')->toBeCalled()->with($this->newhandler)->andReturn(true);

                $test = $this->middleware->process($this->request, $this->handler->get());

                expect($test)->toBe($this->response);

            });

        });

        context('when the session_set_save_handler method returns false', function () {

            it('should throw a SessionHandlerCantBeSetException', function () {

                allow('session_set_save_handler')->toBeCalled()->with($this->newhandler)->andReturn(false);

                $test = function () {

                    $this->middleware->process($this->request, $this->handler->get());

                };

                $exception = new SessionHandlerCantBeSetException;

                expect($test)->toThrow($exception);

            });

        });

    });

});
