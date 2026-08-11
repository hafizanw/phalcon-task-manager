<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction(): string
    {
        return 'Phalcon Todo berhasil berjalan!';
    }

    public function dbTestAction(): string
    {
        try {
            // Ambil service db dari Dependency Injector
            $connection = $this->di->get('db');

            // Jalankan query sederhana untuk tes koneksi
            $connection->query('SELECT 1');

            return 'Koneksi MySQL berhasil!';
        } catch (\Throwable $e) {
            return 'Koneksi MySQL gagal: ' . $e->getMessage();
        }
    }
}