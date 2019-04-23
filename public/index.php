<?php
define('CORE_DIR', dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR);
define('CTRL_DIR', dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR);
define('VIEW_DIR', dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class_name) {
    $file = CORE_DIR . $class_name . '.php';
    if ( !is_file($file) ) $file = CTRL_DIR . $class_name . '.php';
    if ( !is_file($file) ) $file = VIEW_DIR . $class_name . '.php';
    include $file; 
});

$router = new Router();

$router->on('GET', '/',                 function () { $loader = new Loader(); $loader->homePage(); });
$router->on('GET', '/negocio',          function () { $loader = new Loader(); $loader->negocioPage(); });
$router->on('GET', '/governanca',       function () { $loader = new Loader(); $loader->governancaPage(); });
$router->on('GET', '/sustentabilidade', function () { $loader = new Loader(); $loader->sustentabilidadePage(); });
$router->on('GET', '/empresa',          function () { $loader = new Loader(); $loader->empresaPage(); });
$router->on('GET', '/contato',          function () { $loader = new Loader(); $loader->contatoPage(); });

$router->run($router->method(), $router->uri());

?>