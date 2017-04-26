<?php

    /**
     * @param string $class
     * @param string $root
     * @return app\Init\IApp
     */
    function createInit($class, $root)
    {
        $initAutoloadFn = function ($className) use ($root) {
            $file =  $root . '/' . str_replace('\\', '/', $className) . '.php';
            require $file;
        };
        spl_autoload_register($initAutoloadFn);

        $init = new $class($root);

//        spl_autoload_unregister($initAutoloadFn);
//        unset($initAutoloadFn);

        return $init;
    }