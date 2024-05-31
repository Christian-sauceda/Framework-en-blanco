<?php

use MVC\Router;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/doctrine.php'; // Inicializa el EntityManager

// Define tus rutas
$routes = [
    '/login' => 'LoginController@login',

    // Agrega más rutas según sea necesario
];

// Crea una instancia del enrutador y pasa las rutas
$router = new Router($routes);

// Comprueba las rutas y maneja la solicitud
$router->comprobarRutas($entityManager);
