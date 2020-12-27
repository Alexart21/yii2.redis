<?php

use app\assets\AuthAsset;
//use app\assets\AdminLteAsset;
use yii\helpers\Html;

AuthAsset::register($this);
//AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- <base href="/adminlte/"> -->
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
<?php $this->beginBody() ?>
<a href="/" style="display: block;width: 240px;height: 138px;position: absolute;left: 0;top: 0;background: opacity"></a>
<!--<img src="/img/main_img/logo.png" style="position: absolute;opacity: .5;z-index: -10"></img>-->
<br>
<br>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
