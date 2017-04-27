<?php

namespace app\Service\Storage;

/**
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
interface IStorage
{
    public function save(\app\Model\IModel $model): bool;

    public function get(array $condition): array;
}
