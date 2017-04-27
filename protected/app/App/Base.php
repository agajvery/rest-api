<?php

namespace app\App;

/**
 * Description of Base
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
abstract class Base implements IApp
{
    /**
     * mini service locator
     * @var array
     */
    static protected $services = [];

    /**
     * path to controllers
     * @var string
     */
    public $controllerDir = 'Controller';

    /**
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (isset($config['servise'])) {
            $this->buildServices($config['servise']);
            unset($config['servise']);
        }
        foreach ($config as $paramName => $value) {
            $this->$paramName = $value;
        }
    }

    /**
     *
     * @param string $serviceName
     * @return \app\Service\IService
     * @throws Exception
     */
    public static function getService(string $serviceName): \app\Service\IService
    {
        if (!isset(self::$services[$serviceName])) {
            throw new \Exception(sprintf('Service %s doesn\'t found', $serviceName));
        }
        return self::$services[$serviceName];
    }

    /**
     * build service 
     * @param array $config
     */
    protected function buildServices(array $config)
    {
        foreach ($config as $serviceName => $serviceConfig) {
            if (isset($serviceConfig['class'])) {
                $className = $serviceConfig['class'];
                unset($serviceConfig['class']);

                $service = new $className($serviceConfig);
                $service->init();
                self::$services[$serviceName] = $service;
            }
        }
    }
}
