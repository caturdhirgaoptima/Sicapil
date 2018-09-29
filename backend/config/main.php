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
                '@/beranda' => 'verifikator/beranda/index',
                '@/verifikasi' => 'verifikator/verifikasi/index',
                '@/verifikasi/do/<id:\d+>' => 'verifikator/verifikasi/update',
                '@/verifikasi/detail/<id:\d+>' => 'verifikator/verifikasi/view',
                 '@/verifikasi/download/<id:\d+>' => 'verifikator/verifikasi/download',


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
                '$/master-layanan/<controller:(urusan-layanan)>/<id:\d+>' => 'superadmin/<controller>/index',


                '$/master-formulir/<controller:(formulir)>' => 'superadmin/<controller>/index',
                '$/master-formulir/<controller:(formulir|data-formulir)>/create' => 'superadmin/<controller>/create',
                '$/master-formulir/<controller:(formulir|data-formulir)>/<id:\d+>' => 'superadmin/<controller>/view',
                '$/master-formulir/<controller:(formulir|data-formulir)>/<action:(update|delete)>/<id:\d+>/' => 'superadmin/<controller>/<action>',
                 '$/master-formulir/formulir/<controller:(data-formulir)>/<id:\d+>' => 'superadmin/<controller>/index',

                '$/master-dokumen/<controller:(dokumen)>' => 'superadmin/<controller>/index',
                '$/master-dokumen/<controller:(dokumen)>/create' => 'superadmin/<controller>/create',
                '$/master-dokumen/<controller:(dokumen)>/<id:\d+>' => 'superadmin/<controller>/view',
                '$/master-dokumen/<controller:(dokumen)>/<action:(update|delete)>/<id:\d+>/' => 'superadmin/<controller>/<action>',
                '$/master-dokumen/set-dokumen' => 'superadmin/set-dokumen/index',
                '$/master-dokumen/set-dokumen/populate-urusan/<id:\d+>' => 'superadmin/set-dokumen/populate-urusan',
                '$/master-dokumen/set-dokumen/dokumen-ajax/' => 'superadmin/set-dokumen/dokumen-ajax',
                 '$/master-dokumen/set-dokumen/post-dokumen' => 'superadmin/set-dokumen/post-dokumen',


                 '$/master-formulir/set-formulir' => 'superadmin/set-formulir/index',
                 '$/master-formulir/set-formulir/formulir-ajax/' => 'superadmin/set-formulir/formulir-ajax',
                 '$/master-dokumen/set-formulir/post-formulir' => 'superadmin/set-formulir/post-formulir',
            ],

        ],
        'defaultRoute' => 'site/login',
       
    ],
    'params' => $params,
];
