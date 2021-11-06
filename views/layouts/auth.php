<?php

use app\assets\AuthAsset;
//use app\assets\AdminLteAsset;
use yii\helpers\Html;

AuthAsset::register($this);
//AdminLteAsset::register($this);
header('X-Frame-Options: sameorigin');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1;mode=block');
/* При подключении аналитики проверь адреса Content-Security-Policy: script-src */
header('Content-Security-Policy: default-src \'self\' \'unsafe-inline\' \'unsafe-eval\'; img-src \'self\' data:; style-src \'unsafe-inline\' \'unsafe-eval\' \'self\'; script-src \'self\' *.google.com www.gstatic.com \'unsafe-inline\' \'unsafe-eval\'; frame-src *.google.com gstatic.com');
header('Permissions-Policy:
    geolocation=(\'none\'),
    camera=(\'none\'),
    microphone=(\'none\')');
header('Referrer-Policy: origin-when-cross-origin');
header('Strict-Transport-Security: max-age=31536000');
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
    <link rel="icon" type="image/png" href="/icons/64x64.png"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="HandheldFriendly" content="true">
</head>
<body>
<?php $this->beginBody() ?>
<div class="topMenu">
    <a href="/"
       style="display: block;width: 240px;height: 138px;position: absolute;left: 0;top: 0;background: opacity;z-index: 10000">
        <a href="/" title="на глывную"><i class="fa fa-home"></i></a>&nbsp;
        <?php
        if(!Yii::$app->user->isGuest) :
            $imgLink = Yii::$app->user->identity->avatar_path ? '/upload/users/usr' . Yii::$app->user->identity->id . '/img/' .Yii::$app->user->identity->avatar_path  : '/upload/default_avatar/no-image.png';
            ?>
            <img class="avatar-icon" src="<?= $imgLink ?>" alt="">
            <b>[<?= Yii::$app->user->identity->username ?>]</b>
            &nbsp;<a href="/user/logout" data-method="post" title="выйти"><i class="fa fa-external-link-alt" style="transform: rotateZ(45deg)"></i></a>
        <?php
        endif;
        ?>
    </a>
</div>
<!--<img src="/img/main_img/logo.png" style="position: absolute;opacity: .5;z-index: -10"></img>-->
<br>
<br>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
