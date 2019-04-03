<?php

namespace app\controllers;


use app\engine\Renderer;
use app\interfaces\IRenderer;
use app\model\Basket;
use app\model\Users;

class Controller implements IRenderer
{
    private $action;
    private $defaultAction = "index";
    private $layout = 'main';
    protected $useLayout = true;
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


        if ($this->useLayout) {
            return $this->renderTemplate(
                "layouts/{$this->layout}",
                ['content' => $this->renderTemplate($template, $params),
                    'countGoods' => Basket::getCountWhere('session_id', session_id()),
                    'auth' => Users::isAuth(),
                    'username' => Users::getName(),
                    'items' => Basket::getGoods(),


                    ]
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