<?php

namespace app\Service;

/**
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
class Request extends Base implements IRequest
{
    /**
     * $_GET params
     * @var array
     */
    private $getParams = [];

    /**
     * $_POST params
     * @var array
     */
    private $postParams = [];

    /**
     *
     * @var string
     */
    private $method;

    /**
     *
     * @var string
     */
    private $pathInfo;

    public function init()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? null;
        $this->pathInfo = $_SERVER['PATH_INFO'] ?? '';
        $this->getParams = $_GET;
        $this->postParams = file_get_contents('php://input');
    }

    /**
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getParam(string $name, $defaultValue = null)
    {
        return $this->getParams[$name] ?? $defaultValue;
    }

    /**
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function postParam(string $name, $defaultValue = null)
    {
        return $this->postParams[$name] ?? $defaultValue;
    }

    /**
     *
     * @return string
     */
    public function pathInfo(): string
    {
        return $this->pathInfo;
    }

    /**
     *
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }
}
