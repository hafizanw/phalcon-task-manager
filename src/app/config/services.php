<?php

declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Request;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Db\Adapter\Pdo\Mysql;

$di = new FactoryDefault();


// ============================================================
// CONFIG
// ============================================================

$di->setShared('config', function () {
    return require BASE_PATH . '/app/config/config.php';
});


// ============================================================
// REQUEST
// ============================================================

$di->setShared('request', function () {
    return new Request();
});


// ============================================================
// ROUTER
// ============================================================

$di->setShared('router', function () {

    $router = new Router();

    // Namespace default untuk controller
    $router->setDefaultNamespace('App\\Controllers');

    // Halaman utama
    $router->addGet('/', [
        'controller' => 'index',
        'action'     => 'index',
    ]);

    $router->addGet('/db-test', [
        'controller' => 'index',
        'action' => 'dbTest',
    ]);

    return $router;
});


// ============================================================
// VIEW
// ============================================================

$di->setShared('view', function () {

    // Ambil konfigurasi aplikasi
    $config = $this->getConfig();

    // Membuat View
    $view = new View();

    // Menghubungkan View dengan DI Container
    $view->setDI($this);

    // Menentukan lokasi folder views
    $view->setViewsDir(
        $config->application->viewsDir
    );

    // Menggunakan PHP sebagai template engine
    $view->registerEngines([
        '.phtml' => PhpEngine::class,
    ]);

    return $view;
});


// ============================================================
// DATABASE
// ============================================================

$di->setShared('db', function () {

    // Ambil konfigurasi
    $config = $this->getConfig();

    // Buat koneksi MySQL
    return new Mysql([
        'host'     => $config->database->host,
        'port'     => $config->database->port,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
    ]);
});


return $di;