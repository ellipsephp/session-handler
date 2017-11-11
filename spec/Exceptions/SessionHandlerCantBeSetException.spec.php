<?php

use Ellipse\Session\Exceptions\SessionHandlerCantBeSetException;

describe('SessionHandlerCantBeSetException', function () {

    beforeEach(function () {

        $this->exception = new SessionHandlerCantBeSetException;

    });

    it('should extend RuntimeException', function () {

        expect($this->exception)->toBeAnInstanceOf(RuntimeException::class);

    });

});
