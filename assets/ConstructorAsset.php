<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.js',
        'vue_assets/js/app.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
