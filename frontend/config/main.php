<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'js' => [
                        '/vendor/tether/tether.min.js',
                        '/vendor/bootstrap/bootstrap.min.js',

                    ],
                    'css' => [
                        '/css/bootstrap.min.css',
                        '/css/bootstrap-extend.min.css',
                    ]
                ],
                'yii\web\JqueryAsset' => [
                    'js' => [
                        '/vendor/jquery/jquery.min.js',
                    ]
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
                [
                    'pattern' => '<controller>/<action>/<id:\.+>',
                    'route' => '<controller>/<action>',
                    'suffix' => '',
                ],
                'company' => '/company/index',
                'signup' => '/site/signup',
            ],
        ],

    ],
    'params' => $params,
];
