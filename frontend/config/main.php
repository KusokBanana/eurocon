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
    'bootstrap' => ['log', 'chat'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
//        'session' => [
////             this is the name of the session cookie used for login on the frontend
//            'name' => 'advanced-frontend',
//        ],
        'session' => [
            'class' => '\frontend\components\CustomDbSession',
             'db' => 'db',  // the application component ID of the DB connection.
            'sessionTable' => \frontend\models\SessionFrontendUser::tableName(), // session table name.
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
                'rmrevin\yii\fontawesome\AssetBundle' => [
                    'css' => [
                        '/fonts/font-awesome/font-awesome.min.css',
                    ]
                ],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyAQOPXYob7TnbxAsrMsOhlBeBDJRfT7bYE',
                        'language' => 'id',
                        'version' => '3.1.18'
                    ]
                ]
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
                'communities' => '/community/index',
                'signup' => '/site/signup',
                'login' => '/site/login',
                'projects' => '/project',
                'profile' => '/person/profile'
            ],
        ],
    ],
    'on beforeAction' => function(){
        if(!Yii::$app->user->isGuest){
            \common\models\User::updateAll(['last_seen'=>time()],['id'=>Yii::$app->user->id]);
        }
    },
    'modules' => [
        'chat' => [
            'class' => 'frontend\modules\chat\Module',
        ]
    ],

    'params' => $params,
];
