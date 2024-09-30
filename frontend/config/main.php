<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'aliases' => [
        '@uploadedPengaduanFilesPath' => '@app/web/upload/pengaduan/lampiran',
        '@uploadedLampiranPermohonanFilesPath' => '@app/web/upload/permohonan/lampiran',
    ],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'httpClient' => [
            'class' => 'yii\httpclient\Client',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '_session-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/' . date('Y') . '/' . date('m') . '/' . date('d') . '/app.log',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['request'],
                    'logFile' => '@runtime/logs/' . date('Y') . '/' . date('m') . '/' . date('d') . '/request.log',
                    'levels' => ['info'],
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
            ],
        ],
        'uploadUrlManager' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => 'http://http://36.92.145.235:8081/upload/pengaduan/lampiran',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'gridview' =>  [
             'class' => '\kartik\grid\Module',
             'bsVersion' => '3.x',
         ]
    ],
    'timeZone' => 'Asia/Makassar',
    'params' => $params,
    'language' => 'id',
];
