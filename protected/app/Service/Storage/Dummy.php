<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\Service\Storage;

/**
 * Dummy storage
 * @author haivoronskyi.oleksandr@gmail.com
 */
class Dummy extends \app\Service\Base implements IStorage
{
    /**
     * get data
     * @param array $condition
     * @return array
     */
    public function get(array $condition): array
    {
        if (isset($condition['table']) && $condition['table'] === 'transaction') {
            return [
                ['email' => 'test@gmail.com', 'amount' => 100]
            ];
        }
        return [];
    }

    /**
     * save data
     * @param \app\Model\IModel $model
     * @return bool
     */
    public function save(\app\Model\IModel $model): bool
    {
        $model->id = mt_rand(100, 1000);
        return true;
    }

    public function init()
    {

    }
}
