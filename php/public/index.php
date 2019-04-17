<?php
define('CORE_DIR', dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR);
define('CTRL_DIR', dirname(__FILE__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class_name) {
    $file = CORE_DIR . $class_name . '.php';
    if ( !is_file($file) ) $file = CTRL_DIR . $class_name . '.php';
    include $file; 
});

// require_once(dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Router.php');

$router = new Router();

$router->on('GET', '/', function () { 
    $loader = new Loader();
    $loader->homePage();
});

// $router->on('GET', '/home', 'DevMania\App\Controller\Dashboard->loadPage');


// $router->on('GET', '/usuario/id/:id/nome/:nome', 'DevMania\App\HeroController->action', ['labels' => false]); // Esse é de teste
// $router->on('GET', '/:path*', function (HeroController $heroController, $path) { return $heroController->home($path);}); // Esse é de teste
$router->run($router->method(), $router->uri());

?>