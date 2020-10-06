<?php

namespace app\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
//        'css/animate.min.css',
//  'css/font-awesome.css',
        'fontawesome/css/all.min.css',
//        'fontawesome/css/brands.min.css',
    ];
    public $js = [
//        'fontawesome/js/brands.js'
    ];
    public $depends = [
//        'yii\web\JQueryAsset',
//        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
