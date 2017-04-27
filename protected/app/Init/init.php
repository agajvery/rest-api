<?php

    /**
     * register autoloader and build init component
     * 
     * @param string $class
     * @param string $root
     * @param bool $isDebug
     * @return app\Init\IApp
     */
    function createInit(string $class, string $root, bool $isDebug = false)
    {
        $initAutoloadFn = function ($className) use ($root) {
            $file =  $root . '/' . str_replace('\\', '/', $className) . '.php';
            require $file;
        };
        spl_autoload_register($initAutoloadFn);

        $init = new $class($root, $isDebug);
        return $init;
    }