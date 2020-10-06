<?php

namespace app\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/auth.css',
        'fontawesome/css/all.min.css',
    ];

    public $js = [
        'js/velocity.min.js',
        'js/velocity.ui.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}