<?php

namespace app\App;

/**
 * Description of Base
 *
 * @author agajvery
 */
abstract class Base implements IApp
{
    static protected $services = [];
    
    public function __construct($config)
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

    public static function getService($serviceName)
    {
        if (!isset(self::$services[$serviceName])) {
            throw new Exception(sprintf('Service %s doesn\'t found', $serviceName));
        }
        return self::$services[$serviceName];
    }
}
