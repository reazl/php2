<?php
session_start();
include "../engine/Autoload.php";
require_once "../vendor/autoload.php";
include "../config/config.php";

use app\model\Products;
use app\engine\Autoload;
use app\engine\TwigRenderer;
use app\engine\Renderer;
use app\engine\Request;

spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();
//$user = new \app\model\Users(1, 'admin', '123');

$controllerName = $request->getControllerName()?: 'product';
$actionName = $request->getActionName();

$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRenderer());
    $controller->runAction($actionName);
}


