<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.53615a5c.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.4c60f137.js',
        'vue_assets/js/app.93bab18f.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
