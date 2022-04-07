<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.fec2e6d7.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.177daa20.js',
        'vue_assets/js/app.0938ddd4.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
