<?php

echo "Home";
//phpinfo(); //los archivos php no se cierran para que las clases se preserven abiertas 

//Hier ist der Einstiegpunkt in unsere app 

//fehrelermeldungen aktivieren
error_reporting(error_level:E_ALL);
ini_set(option:'display_errors', value: '1');

//echo'Hallo 2306 / -7';


//Autoloading
require_once __DIR__ . '/../vendor/autoload.php';

//codigo temporal
//$controller = new \App\Controller\HomeController(); //esto crea un objeto llamado desde el controlador(HomeController) y llama al metodo index()
//$controller->index();

//https://github.com/nikic/FastRoute   composer require nikic/fast-route

//Fast-Route-Library

//dispatcher einrichten
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controller\HomeController::index');   //das ist der handler
    // {id} must be a number (\d+)
   // $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
   // $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});



//HTTP-Methode und URI abrufen
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI  Unnötige URL-Teile enfernen 
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

//routing abgleichen 

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode('::', $handler, 2);
        call_user_func_array([new $class, $method], $vars);
        // ... call $handler with $vars
        break;
}