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
    'modules' => [],
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
                    'class' => 'yii\log\FileTarget',
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
                '@/beranda' => 'verifikator/index',
                '$/beranda' => 'superadmin/beranda/index',
                '$/<controller:(layanan|user)>' => 'superadmin/<controller>/index',
                '$/<controller:(layanan|user)>/create' => 'superadmin/<controller>/create',
                '$/<controller:(layanan|user)>/<id:\d+>' => 'superadmin/<controller>/view',
                '$/<controller:(layanan|user)>/<action:(update|delete)>/<id:\d+>/' => 'superadmin/<controller>/<action>',
            ],
        ],
        'defaultRoute' => 'site/backendlogin',
       
    ],
    'params' => $params,
];
