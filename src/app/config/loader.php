<?php

use Phalcon\Autoload\Loader;

$loader = new Loader();

$loader->setNamespaces([
    'App\\Controllers' => BASE_PATH . '/app/controllers/',
    'App\\Models' => BASE_PATH . '/app/models/',
]);

$loader->register();