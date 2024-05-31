<?php

require_once __DIR__ . '/vendor/autoload.php';

// Configura Doctrine
require __DIR__ . '/config/db-config.php';

// Devuelve el EntityManager de Doctrine para su uso global
return $entityManager;
