<?php

// En el archivo index.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/doctrine.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../src/Controller/BaseController.php';
require_once __DIR__ . '/../src/Controller/ProductController.php'; // Importa ProductController

$entityManager = require __DIR__ . '/../config/doctrine.php';

$router = new Router();

$router->add('GET', '/', function() use ($entityManager) {
    // Aquí puedes redirigir a otra página, o realizar otras acciones si es necesario
    echo "Welcome to my framework";
});

// Ruta para mostrar la lista de productos
$router->add('GET', '/products', function() use ($entityManager) {
    $controller = new ProductController($entityManager);
    $controller->productList();
});

$request = new Request();
$router->dispatch($request->server['REQUEST_METHOD'], $request->server['REQUEST_URI']);
