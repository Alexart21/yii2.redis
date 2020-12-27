<?php

use yii\helpers\Html;
use app\assets\AdminLteAsset;

AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" type="image/png" href="/icons/64x64.png" />
        <link rel="stylesheet" href="/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="/css/admin_style.css">
        <link rel="stylesheet" href="/css/glyphicons.css">
        <script src="/js/admin_script.js"></script>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <!--LOADER-->
    <div id="loader">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px"
             width="70px" height="70px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;"
             xml:space="preserve">
  <path fill="#e61b05"
        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
  </path>
  </svg>
    </div>
    <!---->
    <div class="wrapper">
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    </div>
    <?php $this->endBody() ?>
    <script>
        $(document).on('pjax:beforeSend', function () {
            document.body.style.cursor = 'progress';
            $('#loader').css('visibility', 'visible');
        });

        $(document).on('pjax:complete', function () {
            document.body.style.cursor = 'default';
            $('#loader').css('visibility', 'hidden');
        });
        // отсебятина. По клику скрываем лого в левом сайдбаре
        const lbt = document.getElementById('left-togle');
        lbt.onclick = function () {
            const logo = document.getElementById('logo');
            logo.classList.toggle('logo-displ');
        }
    </script>
    </body>
    </html>
<?php $this->endPage() ?>