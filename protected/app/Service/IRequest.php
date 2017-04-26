<?php

namespace app\Service;

/**
 *
 * @author agajvery
 */
interface IRequest
{
    public function method();

    public function pathInfo();
}
