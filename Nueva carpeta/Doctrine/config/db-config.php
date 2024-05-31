<?php

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';

// Configuración de las rutas de las entidades y el modo de desarrollo
$paths = [__DIR__ . '/../src/Entity'];
$isDevMode = true;

// Parámetros de conexión
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'tu_usuario',
    'password' => 'tu_contraseña',
    'dbname'   => 'tu_base_de_datos',
];

$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
