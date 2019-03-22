<?php

namespace app\engine;

use app\controllers\Controller;
use app\interfaces\IRenderer;
use app\model\Products;

class TwigRenderer implements IRenderer
{
    public function renderTemplate($template, $params = []) {
        require_once "../vendor/autoload.php";
        $loader = new \Twig\Loader\FilesystemLoader('../twig');
        $twig = new \Twig\Environment($loader);
        /*$catalog = Products::getAll();
        $id = (int)$_GET['id'];
        */
        extract($params);


//        $product = Products::getOne($id);
        $twigTemplate = $template . ".tmpl";
        return $twig->render($twigTemplate, $params);
    }
}
