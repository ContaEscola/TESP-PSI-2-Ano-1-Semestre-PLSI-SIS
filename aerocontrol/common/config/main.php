<?php
return [
    'name' => 'Aerocontrol',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        'formatter' => [
            'datetimeFormat' => 'php:d-m-Y H:i',
            'dateFormat' => 'php:d-m-Y',
            'timeFormat' => 'php:H:i',
            'nullDisplay' => 'N/A'
        ]
    ],
    'timeZone' => 'Europe/Lisbon',
];
