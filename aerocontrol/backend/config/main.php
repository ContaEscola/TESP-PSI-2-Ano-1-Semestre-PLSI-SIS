<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule','controller' => 'api/restaurant'],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/store'],
                ['class' => 'yii\rest\UrlRule','controller' => 'api/user'],
                [
                    'class' => 'yii\rest\UrlRule','controller' => 'api/auth',
                    'extraPatterns' => [
                        'GET login' => 'login'  // Faz a action "login"
                    ],
                ]
            ],
        ],

        'formatter' => [
            'datetimeFormat' => 'php:d-m-Y H:i',
            'timeFormat' => 'php:H:i',
            'nullDisplay' => 'N/A'
        ]

    ],
    'params' => $params,
];
