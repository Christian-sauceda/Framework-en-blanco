<?php

$entityManager = require_once __DIR__ . '/../bootstrap.php';

// Aquí puedes utilizar el entityManager para interactuar con la base de datos

use Entity\Usuario;

// Crear un nuevo usuario
$usuario = new Usuario();
$usuario->setNombre('Juan Pérez');

$entityManager->persist($usuario);
$entityManager->flush();

echo "Creado usuario con ID " . $usuario->getId();
