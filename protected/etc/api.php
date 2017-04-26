<?php

use \app\Service;

return [
//    'db' => [
//        'class' => 'Storag\Db',
//    ],
        'request' => [
            'class' => Service\Request::class,
        ],
        'urlManager' => [
            'class' => Service\UrlManager::class,
            'rules' => [
                [
                    'method' => Service\UrlManager::METHOD_POST,
                    'pattern' => '/\/transaction\/[a-z0-9@-_.]+\/[0-9.]+/',
                ]
            ],
            'requestServise' => 'request',
        ]
];

