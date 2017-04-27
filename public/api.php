<?php
    define('IS_DEBUG', false);
	define('ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'protected'));
    
    require ROOT . DIRECTORY_SEPARATOR . '/app/Init/init.php';

    $init = createInit(\app\Init\Api::class, ROOT, IS_DEBUG);
    $init->run();