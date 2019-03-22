<?php
include "../engine/Autoload.php";
include "../config/config.php";

use app\model\Products;
use app\engine\Autoload;
use app\engine\TwigRenderer;
use app\engine\Renderer;

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c']?: 'product';
$actionName = $_GET['a'];

$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";

//var_dump($controllerClass, $actionName);
/*$product1 = new Products(1, 'Пицца', 'Круглая, с сыром', 17, 1);
$product1->addObj();*/

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Renderer());
    $controller->runAction($actionName);
}


