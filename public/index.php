<?php
//phpinfo(); //los archivos php no se cierran para que las clases se preserven abiertas 

//Hier ist der Einstiegpunkt in unsere app 

//fehrelermeldungen aktivieren
error_reporting(error_level:E_ALL);
ini_set(option:'display_errors', value: '1');

echo'Hallo 2306 / -7';


//Autoloading
require_once __DIR__ . '/../vendor/autoload.php';

$controller = new \App\Controller\HomeController(); //esto crea un objeto llamado desde el controlador(HomeController) y llama al metodo index()
$controller->index();
