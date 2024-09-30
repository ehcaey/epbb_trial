<?php
return [
    'name' => 'E-PBB Kota Kendari',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'smtp.gmail.com',
                'port' => '587',
 
                'username' => 'kendaribapenda@gmail.com',
                'password' => 'tievagdyktwppqsi',
                'streamOptions' => [ 
                    'ssl' => [ 
                        'allow_self_signed' => true, 
                        'verify_peer' => false, 
                        'verify_peer_name' => false, 
                    ], 
                ],
            ],
        ],
    ], 
];
