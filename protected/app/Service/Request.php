<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\Service;

/**
 * Description of Request
 *
 * @author agajvery
 */
class Request extends Base implements IRequest
{
    private $getParams = [];
    
    private $postParams = [];

    private $method;

    private $pathInfo;

    public function init()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? null;
        $this->pathInfo = $_SERVER['PATH_INFO'] ?? '';
        $this->getParams = $_GET;
        $this->postParams = file_get_contents('php://input');
    }

    public function getParam($name, $defaultValue = null)
    {
        return $this->getParams[$name] ?? $defaultValue;
    }

    public function postParam($name, $defaultValue = null)
    {
        return $this->postParams[$name] ?? $defaultValue;
    }

    public function pathInfo()
    {
        return $this->pathInfo;
    }

    public function method()
    {
        return $this->method;
    }
}
