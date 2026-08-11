<?php

use Dotenv\Dotenv;

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

return new \Phalcon\Config\Config([
    'app' => [
        'name' => 'Phalcon Todo',
        'env' => $_ENV['APP_ENV'] ?? 'development',
    ],

    'database' => [
        'adapter' => 'mysql',
        'host' => $_ENV['DB_HOST'] ?? 'host.docker.internal',
        'port' => (int) ($_ENV['DB_PORT'] ?? 3306),
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? 'root',
        'dbname' => $_ENV['DB_DATABASE'] ?? 'phalcon_todo',
    ],

    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ]
]);
