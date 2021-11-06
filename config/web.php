<?php
/* Критичные данные не сливаем на GitHub храним отдельно !!! */

// use app\models\User;

$my_config = parse_ini_file(__DIR__ . '/../.secret/config.ini');
if(!$my_config){
    die('Не найден файл ' . __DIR__ . '/../.secret/config.ini');
}
$params = require(__DIR__ . '/params.php');

/* Сливаем секреты с обычными данными */
/* В этом файле доступ к секретам через $my_config[]
    в других частях приложения через Yii::$app->params
 */
$params = array_merge($params, $my_config);
//var_dump($my_config);die;
$config = [
    /* Сайт на техобслуживании */
    /*'catchAll' => [
        '/closed'
    ],*/
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'name' => 'Alex-art21',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'language' => 'ru',
    'modules' => [
        'alexadmx' => [ // подключаем модуль админки
            'class' => 'app\modules\alexadmx\Module',
            'layout' => 'main'
        ],
        /*'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/original_img', //path to origin images
            'imagesCachePath' => 'upload/resize_img', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/upload/store/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],*/
    ],
    'components' => [
        'formatter' => [
            'datetimeFormat' => 'php:d F Y H:i:s',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => $my_config['G_clientId'],
                    'clientSecret' => $my_config['G_clientSecret'],
//                    'returnUrl' => 'https://alexart.houme21.ru/site/auth?authclient=google',
                ],
                'yandex' => [
                    'class' => 'yii\authclient\clients\Yandex',
                    'clientId' => $my_config['Y_clientId'],
                    'clientSecret' => $my_config['Y_clientSecret'],
                ],
                'mailru' => [
                    'class' => 'isudakoff\authclient\MailRu',
                    'clientId' => $my_config['MailRu_clientId'],
                    'clientSecret' => $my_config['MailRu_clientSecret'],
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => $my_config['VK_clientId'],
                    'clientSecret' => $my_config['VK_clientSecret'],
                    'scope' => ['email'],
                ],
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => $my_config['Git_clientId'],
                    'clientSecret' => $my_config['Git_clientSecret'],
                ],
            ],

        ],
        'backup' => [
            'class' => 'demi\backup\Component',
            // The directory for storing backups files
            'backupsFolder' => __DIR__ . '/../.backups', // <project-root>/backups
            // Directories that will be added to db-backup
            'directories' => [
                'img' => '@app/web/img',
            ],
            // не будет автоудаления
            'expireTime' => null,
            // бэкап БД реализовал по другому
            'db' => false,
        ],
        /*'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],*/
        /* Redis кэш */
        /*'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ]
        ],*/
        /*'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ]
        ],*/
        /* Файловый кэш */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => !YII_DEBUG,
            'concatCss' => true, // concatenate css
            'minifyCss' => true, // minificate css
            'concatJs' => true, // concatenate js
            'minifyJs' => true, // minificate js
            'minifyOutput' => true, // minificate result html page
            'webPath' => '@web', // path alias to web base
            'basePath' => '@webroot', // path alias to web base
            'minifyPath' => '@webroot/minify', // path alias to save minify result
            'jsPosition' => [\yii\web\View::POS_END], // positions of js files to be minified
            'forceCharset' => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
            'expandImports' => true, // whether to change @import on content
            'compressOptions' => ['extra' => true], // options for compress
            'excludeFiles' => [
//                'jquery.js', // exclude this file from minification
                'jquery.pjax.js', // exclude this file from minification
                'bootstrap.css', // exclude this file from minification
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dfghdhdh2353w46tvw354645',
            'csrfCookie' => [
                'httpOnly' => true,
            ],
            'baseUrl' => '', // для чпу надо
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/login'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true, // локалка
//            'useFileTransport' => false, // на боевом поставить false
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'alexart21@bk.ru',
                'password' => 'Cbyuekzhyjcnm_211',
                'port' => '465',
                'encryption' => 'tls',
//                'streamOptions' => [ 'ssl' => [ 'allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false, ], ],
            ],

        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'exportInterval' => 100, // макс. кол-во сообщения(default 1000)
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                // слева Url справа controller/action
                '<action:(index|sozdanie|prodvijenie|parsing|portfolio|politic|call|call_ok)>' => 'site/<action>',
                '<action:(login|logout|signup|request-password-reset|reset-password)>' => 'user/<action>',
            ],
        ],

        'reCaptcha' => [ // for houme21.ru
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => $my_config['siteKeyV2'],
            'secretV2' => $my_config['secretV2'],
            'siteKeyV3' => $my_config['siteKeyV3'],
            'secretV3' => $my_config['secretV3'],
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl' => '/web',
                'basePath' => '@webroot',
                'path' => 'upload/global',
                'name' => 'Global'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1'] // adjust this to your needs
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1'] // adjust this to your needs
    ];
}

return $config;
