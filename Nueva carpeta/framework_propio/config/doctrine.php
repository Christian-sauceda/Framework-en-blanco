<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = require __DIR__ . '/config.php';

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$paths = [__DIR__ . '/../src/Entity'];
$dbParams = $config['db'];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;
