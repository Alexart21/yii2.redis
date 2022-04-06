<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.c3441e6c.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.177daa20.js',
        'vue_assets/js/app.43df74c9.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
