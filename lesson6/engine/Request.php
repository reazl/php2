<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $method;
    protected $controllerName;
    protected $actionName;
    protected $params;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        $url = explode('/', $this->requestString);
        $this->controllerName = $url[2];
        $this->actionName = $url[3];
        $this->params = $_REQUEST;

    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }


}