<?php
ini_set('include_path', __DIR__.'/../lib/;'.ini_get('include_path') );

require_once('Doctrine.php');
spl_autoload_register(array('Doctrine', 'modelsAutoload'));//Solo se requiere para cargar modelos
spl_autoload_register(array('Doctrine', 'autoload'));


$manager = Doctrine_Manager::getInstance();

$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
Doctrine::loadModels(__DIR__.'/../models/generated/');
Doctrine::loadModels(__DIR__.'/../models/');

$conn = Doctrine_Manager::connection('mysql://root:@localhost/chat?charset=utf8&collate=utf8_unicode_ci');
