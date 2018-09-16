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
                '$/master-user/<controller:(user|auth-item)>' => 'superadmin/<controller>/index',
                '$/master-user/<controller:(user|auth-item)>/create' => 'superadmin/<controller>/create',
                '$/master-user/<controller:(user|auth-item)>/<id:\d+>' => 'superadmin/<controller>/view',
                '$/master-user/<controller:(user|auth-item)>/<action:(update|delete)>/<id:\d+>/' => 'superadmin/<controller>/<action>',

                '$/master-user/<controller:(auth-assignment)>' => 'superadmin/<controller>/akses',
                
                '$/master-layanan/<controller:(layanan|urusan)>' => 'superadmin/<controller>/index',
                '$/master-layanan/<controller:(layanan|urusan)>/create' => 'superadmin/<controller>/create',
                '$/master-layanan/<controller:(layanan|urusan)>/<id:\d+>' => 'superadmin/<controller>/view',
                '$/master-layanan/<controller:(layanan|urusan)>/<action:(update|delete)>/<id:\d+>/' => 'superadmin/<controller>/<action>',
             
            ],

        ],
        'defaultRoute' => 'site/backendlogin',
       
    ],
    'params' => $params,
];
