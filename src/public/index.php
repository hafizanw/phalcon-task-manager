<?php

// Memastikan PHP menggunakan strict typing.
// Membantu PHP lebih ketat dalam menangani tipe data.
declare(strict_types=1);


// Menentukan lokasi root project.
// Karena file ini berada di /public/index.php,
// dirname(__DIR__) akan menunjuk ke folder /src.
define('BASE_PATH', dirname(__DIR__));


// Memuat autoloader milik Composer.
// Autoloader ini digunakan untuk memuat dependency
// seperti Phalcon, Dotenv, dan library Composer lainnya.
require BASE_PATH . '/vendor/autoload.php';


// Memuat konfigurasi aplikasi.
// File config.php berisi konfigurasi seperti:
// - APP_ENV
// - database
// - lokasi controller
// - lokasi model
// - lokasi view
// - dan konfigurasi aplikasi lainnya.
// $config = require BASE_PATH . '/app/config/config.php';


// Mengaktifkan autoloader Phalcon untuk class aplikasi kita.
// Misalnya:
// App\Controllers\TodoController
// App\Models\Todo
//
// Loader akan mencari class tersebut di folder
// app/controllers/ dan app/models/.
require BASE_PATH . '/app/config/loader.php';


// Membuat dan mengkonfigurasi Dependency Injection (DI) Container.
//
// services.php mendaftarkan berbagai service yang digunakan
// oleh aplikasi, misalnya:
// - router
// - database
// - view
// - session
// - dan service lainnya.
$di = require BASE_PATH . '/app/config/services.php';


// Membuat instance aplikasi utama Phalcon.
//
// Dependency Injection Container ($di) diberikan kepada
// Application agar Phalcon dapat menggunakan service-service
// yang sudah kita daftarkan sebelumnya.
$application = new Phalcon\Mvc\Application($di);


// Menjalankan aplikasi untuk memproses HTTP request.
//
// $_SERVER['REQUEST_URI'] berisi URL yang diminta browser.
// Contoh:
// /
// /todos
// /todos/create
//
// Phalcon akan meneruskan request tersebut ke Router,
// kemudian menentukan Controller dan Action yang sesuai.
//
// getContent() mengambil isi response yang dihasilkan
// oleh aplikasi dan mengirimkannya ke browser.
echo $application->handle(
    $_SERVER['REQUEST_URI']
)->getContent();