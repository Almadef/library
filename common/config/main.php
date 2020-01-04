<?php

use common\helpers\StorageHelper;

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'storage' => [
            'class' => 'snewer\storage\StorageManager',
            'buckets' => [
                StorageHelper::BOOK_BOOK_DESCRIPTION => [
                    'class' => 'snewer\storage\drivers\FileSystemDriver',
                    'basePath' => '@frontend/web/uploads/books/',
                    'baseUrl' => $params['url.frontend'] . '/uploads/books/',
                    'depth' => 4
                ],
                StorageHelper::BOOK_COVER_DESCRIPTION => [
                    'class' => 'snewer\storage\drivers\FileSystemDriver',
                    'basePath' => '@frontend/web/uploads/covers/',
                    'baseUrl' => $params['url.frontend'] . '/uploads/covers/',
                    'depth' => 4
                ],
            ]
        ],
    ],
];
