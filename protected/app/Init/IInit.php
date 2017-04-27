<?php

namespace app\Init;

/**
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
interface IInit
{
    public function run();

    public function getConfigFileName(): string;
}
