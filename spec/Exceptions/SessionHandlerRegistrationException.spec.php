<?php

use Ellipse\Session\Exceptions\SessionHandlerRegistrationException;
use Ellipse\Session\Exceptions\SessionHandlerExceptionInterface;

describe('SessionHandlerRegistrationException', function () {

    beforeEach(function () {

        $this->exception = new SessionHandlerRegistrationException;

    });

    it('should implement SessionHandlerExceptionInterface', function () {

        expect($this->exception)->toBeAnInstanceOf(SessionHandlerExceptionInterface::class);

    });

    it('should extend RuntimeException', function () {

        expect($this->exception)->toBeAnInstanceOf(RuntimeException::class);

    });

});
