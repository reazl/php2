<?php

namespace app\engine;

use app\interfaces\IRenderer;

class TwigRenderer implements IRenderer
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../twig');
        $twig = new \Twig\Environment($loader);
        $this->twig = $twig;
    }


    public function renderTemplate($template, $params = []) {

        $twigTemplate = $template . ".tmpl";
        return $this->twig->render($twigTemplate, $params);
    }
}
