<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.dd3fe926.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.a77a3a80.js',
        'vue_assets/js/app.91a6f52d.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
