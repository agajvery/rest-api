<?php

namespace app\Service;

/**
 * @author haivoronskyi.oleksandr@gmail.com
 */
abstract class Base implements IService
{
    /**
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        foreach ($options as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     *
     * @param string $name
     * @param mixed $value
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
        } else {
            throw new \Exception(sprintf('Propoerty %s doesn\'t exists'));
        }
    }
}
