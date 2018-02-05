# Session handler

This package provides a [Psr-15 middleware](https://www.php-fig.org/psr/psr-15/) allowing to set a custom session handler to your application.

**Require** php >= 7.1

**Installation** `composer require ellipse/session-handler`

**Run tests** `./vendor/bin/kahlan`

- [Using the set session handler middleware](#using-the-set-session-handler-middleware)

# Using the set session handler middleware

For example, a [custom session handler](https://github.com/php-cache/session-handler) using an implementation of [Psr-6](http://www.php-fig.org/psr/psr-6/) can be used instead of the built in session handler:

```php
<?php

namespace App;

use Cache\Adapter\Predis\PredisCachePool;
use Cache\SessionHandler\Psr6SessionHandler;

use Ellipse\Session\SetSessionHandlerMiddleware;

// Get an implementation of php SessionHandlerInterface. Here a session handler
// managing data with redis is used.
$client = new \Predis\Client(...);

$pool = PredisCachePool($client);

$config = ['ttl'=>3600, 'prefix'=>'foobar'];

$handler = new Psr6SessionHandler($pool, $config);

// This middleware will set $handler as the session handler. Obviously it should
// be processed before any call to session_start().
$middleware = new SetSessionHandlerMiddleware($handler);
```
