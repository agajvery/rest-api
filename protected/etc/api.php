<?php

use \app\Service;

return [
        'controllerDir' => 'app\Controller',
        'servise' => [
            'request' => [
              'class' => Service\Request::class,
            ],
            'urlManager' => [
                'class' => Service\UrlManager::class,
                'rules' => [
                    [
                        'method' => Service\UrlManager::METHOD_POST,
                        'pattern' => '/\/transaction\/(?<email>.*)\/(?<amount>.*)/',
                        'action' => 'transaction/save',
                        'avaibleParams' => ['email', 'amount']
                    ]
                ],
                'requestServise' => 'request',
            ],
            'storage' => [
                'class' => \app\Service\Storage\Dummy::class,
            ],
//            'db' => [
//                'class' => 'Storag\Db',
//            ],
        ],
];

