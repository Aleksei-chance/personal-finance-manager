<?php

namespace App\Controllers;

use App\Services\Database;

class HomeController
{
    public function index()
    {
        $db = Database::connect();
        echo "Соединение с базой данных установлено!";
        dump($db);
    }
}
