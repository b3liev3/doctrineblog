<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$entitiesPath = array(__DIR__.'/Blog/Entity');
$config = Setup::createAnnotationMetadataConfiguration($entitiesPath,$dev);
$entityManager = EntityManager::create($dbParams,$config);