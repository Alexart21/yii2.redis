<?php
use app\assets\TestAsset;
use yii\helpers\Html;

TestAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
<script>
    $(document).on('pjax:beforeSend', () => {
        document.body.style.cursor = 'progress';
    });

    $(document).on('pjax:complete', () => {
        document.body.style.cursor = 'default';
        let method = $.pjax.options.type;
        if(method == 'POST'){
            document.getElementById('msg').value = ''; //
        }
        $('#msgs-content').scrollTop($('#msgs-content')[0].scrollHeight);
    });
    //
    function updateList() {
        $.pjax.defaults.timeout = false;
        $.pjax.reload({
            method: 'get',
            container: '#msgs-content'
        });
    }
    setInterval(updateList, 5000);
</script>
</body>
</html>
<?php $this->endPage() ?>
