<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\Service;

/**
 * Description of Base
 *
 * @author agajvery
 */
abstract class Base implements IService
{
    public function __construct($options)
    {
        foreach ($options as $name => $value) {
            $this->$name = $value;
        }
    }

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
