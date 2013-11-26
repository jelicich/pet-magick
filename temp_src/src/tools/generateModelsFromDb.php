<?php
$url = 'mysql://root:@localhost/chat';
//sirve para que el directorio LIB este en nuesro include Path y se encuentre Doctrine.php
ini_set('include_path', __DIR__.'/../lib/;'.ini_get('include_path') );

//carga la clase principal de Doctrine
require_once('Doctrine.php');

//registra el autoloader de Doctrine
spl_autoload_register(array('Doctrine', 'autoload'));

//Doctrine manager administrara las conexiones
$manager = Doctrine_Manager::getInstance();

//Establace la configuracion pero aun no se conecta a la base de datos
$conn = Doctrine_Manager::connection($url);


/*
solicita a la base de datos configurada que genere los objetos de PHP 
en el directorio /../models
por default genera objetos registro, pero con la opcion 
array('generateTableClasses' => true)
le pedimos que tambien genere objetos Tabla
*/
Doctrine_Core::generateModelsFromDb(
    __DIR__.'/../models',
    array(),
    array('generateTableClasses' => true)
);


echo 1;
