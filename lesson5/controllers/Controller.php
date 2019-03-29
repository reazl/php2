<?php

namespace app\controllers;


use app\engine\Renderer;
use app\interfaces\IRenderer;

class Controller implements IRenderer
{
    private $action;
    private $defaultAction = "index";
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;


    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function runAction($action = null)
    {

        $this->action = $action ?: $this->defaultAction;

        $method = "action" . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }


    public function render($template, $params = [])
    {
        $myRenderer = substr(strrchr(get_class($this->renderer), "\\"), 1);

        if ($this->useLayout && $myRenderer == "Renderer") {
            return $this->renderTemplate(
                "layouts/{$this->layout}",
                ['content' => $this->renderTemplate($template, $params)]
            );


        } else {

            return $this->renderTemplate($template, $params);
        }
    }


    public function renderTemplate($template, $params = [])
    {
       return $this->renderer->renderTemplate($template, $params);
    }

}