<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
  'css/style.css',
  'css/animate.min.css',
//  'css/font-awesome.css',
        'fontawesome/css/all.min.css',
        'fontawesome/css/v4-shims.min.css',
    ];
    public $js = [
        'js/indexForm.min.js',
//        'js/slide.min.js',
        'js/wow.min.js',
        'js/velocity.min.js',
        'js/velocity.ui.min.js',
        'js/scripts.js',
    ];
    public $depends = [
//        'yii\web\JQueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
