<?php

namespace app\Init;

/**
 *
 * @author agajvery
 */
interface IInit
{
    function run();

    function getConfigFileName(): string;

//    function getApp(): app\App\IApp;
}
