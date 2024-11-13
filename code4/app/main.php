<?php

header("Content-Type: application/json; charset=UTF-8");

include "C:\xampp\htdocs\Modul4\app\Routes\ProductRoutes.php";

use app\Routes\ProductRoutes;

// MENANGKAP REQUEST METHOD
$method = $_SERVER['REQUEST_METHOD'];
//MENANGKAP REQUEST PATH
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// PANGGIL ROUTES
$productRoutes = new ProductRoutes();
$productRoutes->handle($method, $path);
?>