<?php

namespace app\Service;

/**
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
interface IRequest
{
    public function method(): string;

    public function pathInfo(): string;

    public function getParam(string $name, $defaultValue = null);

    public function postParam(string $name, $defaultValue = null);
}
