<?php

namespace app\App;

/**
 * @author haivoronskyi.oleksandr@gmail.com
 */
class Api extends Base
{
    /**
     * run application
     */
    public function run()
    {
        $this->buildController();
    }

    /**
     * Build and call controller
     * @throws \Error
     */
    protected function buildController()
    {
        $urlManager = $this->getService('urlManager');
        $result = $urlManager->parseUrl();
        
        if (is_null($result)) {
            throw new \Error('Page doen\'t found', 404);
        }
        list($controller, $action) = explode('/', $result);
        $controllerClass = ($this->controllerDir . '\\' . ucfirst($controller));

        if (class_exists($controllerClass)) {
            $actionMethod = ('action' . ucfirst($action));
            $controller = new $controllerClass();
            call_user_func_array([$controller, $actionMethod], $urlManager->getParams());
        }
    }
}
